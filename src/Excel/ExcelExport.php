<?php

namespace DevHau\Modules\Excel;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExcelExport  implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping
{
    use Exportable;
    private $option;
    protected $model;
    private $headingsDefault;
    public function __construct($option)
    {
        $this->option = $option;
        $this->model = app($this->option['model']);
        $this->headingsDefault = getAllAttributeByModel($this->model) ?? [];
    }
    public function query()
    {
        return $this->model->query();
    }

    public function headings(): array
    {
        return getValueByKey($this->option, 'excel.header', $this->headingsDefault);
    }
    public function map($dataRow): array
    {
        $funcMap = getValueByKey($this->option, 'excel.mapdata', null);
        if ($funcMap) {
            return $funcMap($dataRow);
        }
        // This example will return 3 rows.
        // First row will have 2 column, the next 2 will have 1 column
        return $dataRow->toArray();
    }
}
