<?php

namespace app\core;

class Request
{
    public function getPath()
    {
        $path = $_SERVER["REQUEST_URI"] ?? '/';
        $position = strpos($path, "?");

        if ($position === false) {
            return $path;
        }

        $path = substr($path, 0, $position);

        return $path;
    }

    public function getMethod()
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public function all()
    {
        return $_REQUEST;
    }

    public function getOne($prop)
    {
        return isset($_REQUEST[$prop]) ? $_REQUEST[$prop] : null;
    }
}