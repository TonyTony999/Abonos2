<?php

declare(strict_types=1);

namespace App;

use Exception;

class Navbar
{

    public function render(string $userType)
    {
        $navbar = "";
        switch ($userType) {
            case "administrador":
                $navbar = <<<EOD
                <div class="topnav" id="myTopnav">
                <a href="/actividades">Actividades</a>
                <a href="/mensajes">Mensajes</a>
                <a href="/visualizacion?camas">Visualización</a>
                <a href="/gastos">Gastos</a>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
                </a>
                </div>
                EOD;
                break;
            case "asociado":
                $navbar = <<<EOD
                <div class="topnav" id="myTopnav">
                <a href="/actividades">Actividades</a>
                <a href="/visualizacion?camas">Visualización</a>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
                </a>
                </div>
                EOD;
                break;
            case "empleado":
                $navbar = <<<EOD
                <div class="topnav" id="myTopnav">
                <a href="/actividades">Actividades</a>
                <a href="/dashboard">Camas</a>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
                </a>
                </div>
                EOD;
                break;
        }

        return $navbar;
    }
}
