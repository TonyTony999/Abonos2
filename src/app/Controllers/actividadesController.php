<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use App\Models\Actividad;
use App\Models\User;
use App\Navbar;

use Exception;

class actividadesController
{

    public function index()
    {

        if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {


            //$camasInfo = (new Cama)->getCamasHoy();
            $userInfo = $_SESSION["username"];
            $userType = $_SESSION["user_type"];
            $userId = $_SESSION["userId"];
            $navbar= (new Navbar)->render($userType);

            // echo $userType;

            if ($userType === "empleado") {
                $actividades = (new Actividad)->getActividadesByUserId($userId);
                //echo $userId;
                $allUsers = (new User)->getAllUsers();
                $dbData = ["userInfo" => $userInfo, "actividades" => $actividades, "navbar"=>$navbar];

                $view = new View("ActividadesEmp", "/styles/actividadesEmp.css", $dbData);
                return $view->render();
            } else {
                $actividades = (new Actividad)->getActividades();
                $allUsers = (new User)->getAllUsers();
                $dbData = ["userInfo" => $userInfo, "actividades" => $actividades, "users" => $allUsers, "navbar"=>$navbar];

                $view = new View("Actividades", "/styles/actividadesStyle.css", $dbData);

                return $view->render();
            }
        } else {
            header("Location: /");
        }
    }

    public function submitActividad()
    {

        if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {
            $userType = $_SESSION["user_type"];

            if ($userType === "administrador" || $userType === "asociado") {
                $encargado = $_POST["encargado"];
                $titulo = $_POST["titulo"];

                $fechaInicial = $_POST["fecha-inicial"];
                $fechaInicial = explode("/", $fechaInicial);
                $fechaInicial = $fechaInicial[2] . "-" . $fechaInicial[0] . "-" . $fechaInicial[1];
                //$fechaInicial = date('Y-m-d', strtotime($fechaInicial));

                $fechaFinal = $_POST["fecha-final"];
                $fechaFinal = explode("/", $fechaFinal);
                $fechaFinal = $fechaFinal[2] . "-" . $fechaFinal[0] . "-" . $fechaFinal[1];

                $descripcion = $_POST["mensaje"];
                $estado = "No Completado";

                //echo $fechaInicial;
                $user = (new User)->getUserByUsername($encargado);
                $user_id = (int)$user["id"];


                (new Actividad)->postActividad($titulo, $fechaInicial, $fechaFinal, $encargado, $user_id, $descripcion, $estado);
                header("Location: /actividades");
            } else {
                header("Location: /");
            }
        } else {
            header("Location: /");
        }
    }

    public function editEstadoActividad()
    {

        if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {
            $userType = $_SESSION["user_type"];

            if ($userType === "administrador" || $userType === "asociado") {
                $actividadId = (int)$_GET["actividadId"];
                $actividadEstado = $_POST["estado"];
                (new Actividad)->editEstadoActividad($actividadId, $actividadEstado);
                header("Location: /actividades");
            } else {
                header("Location: /");
            }
        } else {
            header("Location: /");
        }
    }

    public function deleteActividad()
    {
        if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {
            $userType = $_SESSION["user_type"];

            if ($userType === "administrador" || $userType === "asociado") {
                $actividadId = (int)$_GET["actividadId"];
                (new Actividad)->deleteActividad($actividadId);
                header("Location: /actividades");
            } else {
                header("Location: /");
            }
        } else {
            header("Location: /");
        }
    }
}
