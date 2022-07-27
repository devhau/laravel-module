<?php

namespace DevHau\Modules\Livewire;

use Livewire\Wireable;

class DataWireable implements Wireable
{
    private $data = [];
    public function toLivewire(): array
    {
        return $this->data;
    }

    public function from($value)
    {
        $this->data = $value;
        return $this;
    }
    public static function fromLivewire($value)
    {
        return (new self())->from($value);
    }
}
