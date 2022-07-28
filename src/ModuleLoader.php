<?php

namespace DevHau\Modules;

class ModuleLoader
{
    private $datas = [];
    private function __construct($datas = [])
    {
        $this->datas = $datas;
    }
    public function getData()
    {
        return $this->datas;
    }

    public function Data($key, $config)
    {
        if (is_null($this->datas) || !is_array($this->datas))  $this->datas = [];
        $this->datas[$key] = $config;
    }
    public function getDataByKey($key, $sub = null)
    {
        return getValueByKey($this->datas, $key . ($sub ?? ''), null);
    }
    public function loadFromFile($file)
    {
        $file = str_replace("\\", "/", $file);
        if (file_exists($file)) {
            $datas = loadFileReturn($file);
            foreach ($datas as $key => $item) {
                $this->Data($key, $item);
            }
        }
    }
    private static $instance = [];
    private static function getModule($key): self
    {
        if (is_null(self::$instance))  self::$instance = [];
        if (!isset(self::$instance[$key])) self::$instance[$key] = new ModuleLoader();
        return self::$instance[$key];
    }
    private const module_theme = "module_theme";
    public static function Theme(): self
    {
        return self::getModule(self::module_theme);
    }
    private const module_table = "module_table";
    public static function Table(): self
    {
        return self::getModule(self::module_table);
    }
    private const module_setting = "module_setting";
    public static function Setting(): self
    {
        return self::getModule(self::module_setting);
    }
}
