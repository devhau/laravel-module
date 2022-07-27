<?php
namespace DevHau\Modules\Builder\Form;

class FieldColor
{
    public const AllColor = ["warning", "info", "danger", "primary", "success"];
    public const secondary = "text-white bg-secondary";
    public const primary = "text-white bg-primary";
    public const success = "text-white bg-success";
    public const danger = "text-white bg-danger";
    public const warning = "text-dark bg-warning";
    public const info = "text-dark bg-info";
    public const light = "text-dark bg-light";
    public const dark = "text-white bg-dark";
    public static function getColor($name)
    {
        switch ($name) {
            case "secondary":
                return self::secondary;
            case "primary":
                return self::primary;
            case "success":
                return self::success;
            case "danger":
                return self::danger;
            case "warning":
                return self::warning;
            case "info":
                return self::info;
            case "light":
                return self::light;
            case "dark":
                return self::dark;
            default:
                return self::warning;
        }
    }
}
