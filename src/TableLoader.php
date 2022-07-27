<?php

namespace DevHau\Modules;

class TableLoader
{
    private $tables = [];
    private function __construct($tables = [])
    {
        $this->tables = $tables;
    }
    public function getTables()
    {
        return $this->tables;
    }
    public function setTables($tables)
    {
        $this->tables = $tables;
    }
    public function table($key, $config)
    {
        if (is_null($this->tables) || !is_array($this->tables))  $this->tables = [];
        $this->tables[$key] = $config;
    }
    public function getTableByKey($key)
    {
        return $this->tables[$key] ?? [];
    }
    public function loadFromFile($file)
    {
        $file = str_replace("\\", "/", $file);
        if (file_exists($file)) {
            $tables = loadFileReturn($file);
            foreach ($tables as $key => $table) {
                $this->table($key, $table);
            }
        }
    }
    private static $instance = null;

    public static function getInstance($tables = []): TableLoader
    {
        if (is_null(self::$instance)) {
            return self::$instance = new self($tables);
        }
        $tables = array_merge(static::$instance->getTables(), $tables);

        static::$instance->setTables($tables);

        return static::$instance;
    }
}
