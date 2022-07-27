<?php

namespace Modules\Core\Common\Widget;

use DevHau\Modules\Common\Color;
use DevHau\Modules\Common\ColumnSize;

class WidgetCore
{
    public $title = "Demo";
    public $size = ColumnSize::Col3;
    public $color = Color::light;
    public $poll = 1;
    public $setting = [];
    public $icon = "";
    public function Fill($data)
    {
        $config = (object)$data;
        $this->title = $config->title;
        $this->icon = $config->icon;
        $this->size = ColumnSize::getSize($config->size);
        $this->color = Color::getColor($config->color);
        $this->poll = $config->poll;
        $this->setting = $config->setting;
    }

    public function getTemplate()
    {
        return WidgetType::Small;
    }
    public function getData()
    {
        return ['name', 'value'];
    }
    public static function Parse($data): WidgetCore
    {
        $config = (object)$data;
        $widget = app($config->widget);
        $widget->Fill($config);
        return $widget;
    }
}
