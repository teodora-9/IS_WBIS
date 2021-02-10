<?php


namespace app\core;


class Response
{
    public function redirect($string)
    {
        header("location:" . $string);
    }
}