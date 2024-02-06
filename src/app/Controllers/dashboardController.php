<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use App\Models\User;
use App\Models\Cama;
use App\Navbar;
use Exception;

class dashboardController
{

    public function index()
    {

        if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {
            $userType = $_SESSION["user_type"];
            if ($userType === "empleado") {

                $userInfo = (new User)->getUser($_SESSION["email"]);
                $camasInfo = (new Cama)->getCamasHoy();
                $navbar= (new Navbar)->render($userType);
                $dbData = ["userInfo" => $userInfo, "camasInfo" => $camasInfo, "navbar"=>$navbar];

                $view = new View("Dashboard", "/styles/dashboardStyle.css", $dbData);
                return $view->render();
            } else {
                header("Location: /visualizacion");
            }
        } else {
            header("Location: /");
        }
    }
}
