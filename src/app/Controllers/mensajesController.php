<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use App\Models\Mensajes;
use App\Navbar;
use Exception;

class mensajesController
{

    public function index()
    {

        if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {
            $userType = $_SESSION["user_type"];
            $navbar= (new Navbar)->render($userType);
            if ($userType === "administrador") {
                $mensajes = (new Mensajes)->getMensajes();

                $dbData = [
                    "userInfo" => $_SESSION,
                    "mensajes" => $mensajes,
                    "navbar"=>$navbar
                ];

                $view = new View("Mensajes", "/styles/mensajesStyle.css", $dbData);

                return $view->render();
            } else {
                header("Location: /");
            }
        } else {
            header("Location: /");
        }
    }

    public function getMessage()
    {

        if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {
            $userType = $_SESSION["user_type"];
            if ($userType === "administrador") {
                $id = $_GET["message-id"];
                $mensaje = (new Mensajes)->getMensaje($id);
                return $mensaje;

            } else {
                header("Location: /");
            }
        } else {
            header("Location: /");
        }
    }
}
