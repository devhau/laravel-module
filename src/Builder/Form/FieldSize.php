<?php

namespace DevHau\Modules\Builder\Form;

class FieldSize
{
    public const Col = "col";
    public const Col1 = "col-xs-12 col-sm-12 col-md-1 col-lg-1";
    public const Col2 = "col-xs-12 col-sm-12 col-md-1 col-lg-2";
    public const Col3 = "col-xs-12 col-sm-12 col-md-4 col-lg-3";
    public const Col4 = "col-xs-12 col-sm-12 col-md-4 col-lg-4";
    public const Col5 = "col-xs-12 col-sm-12 col-md-4 col-lg-5";
    public const Col6 = "col-xs-12 col-sm-12 col-md-4 col-lg-6";
    public const Col7 = "col-xs-12 col-sm-12 col-md-8 col-lg-7";
    public const Col8 = "col-xs-12 col-sm-12 col-md-8 col-lg-8";
    public const Col9 = "col-xs-12 col-sm-12 col-md-8 col-lg-9";
    public const Col10 = "col-xs-12 col-sm-12 col-md-12 col-lg-10";
    public const Col11 = "col-xs-12 col-sm-12 col-md-12 col-lg-11";
    public const Col12 = "col-xs-12 col-sm-12 col-md-12 col-lg-12";
    public static function getSize($name)
    {
        switch ($name) {
            case "Col":
                return self::Col;
            case "Col1":
                return self::Col1;
            case "Col2":
                return self::Col2;
            case "Col3":
                return self::Col3;
            case "Col4":
                return self::Col4;
            case "Col5":
                return self::Col5;
            case "Col6":
                return self::Col6;
            case "Col7":
                return self::Col7;
            case "Col8":
                return self::Col8;
            case "Col9":
                return self::Col9;
            case "Col10":
                return self::Col10;
            case "Col11":
                return self::Col11;
            case "Col12":
                return self::Col12;
            default:
                return self::Col;
        }
    }
}
