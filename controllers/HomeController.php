<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\core\Router;

class HomeController extends Controller
{
    public function dashboard()
    {
       echo $this->view("home", "main", null);
    }

    public function athorize()
    {
        return [
            "Administrator",
            "SuperAdministrator",
            "Korisnik"
        ];
    }
}