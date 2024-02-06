<?php

declare(strict_types=1);

namespace App\Controllers;

use App\App;
use App\View;
use App\DB;
use App\Models\User;


class homeController
{

    public function index()
    {

        $view = new View("Home", "/styles/homestyle.css");
        return $view->render();
     
    }
}
