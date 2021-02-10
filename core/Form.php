<?php


namespace app\core;


class Form
{
    public static function beginForm($action, $method)
    {
        return sprintf("<form action='%s' method='%s'>", $action, $method);
    }

    public static function endForm()
    {
        return "</form>";
    }

    public static function field($model, $attribute, $type)
    {
        return new Field($model, $attribute, $type);
    }
}