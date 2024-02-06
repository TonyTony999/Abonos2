<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use App\Models\User;
use App\Models\Cama;

class apiController
{

    public function getUsers()
    {
        if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {
            $userInfo = (new User)->getAllUsersJson();
            return $userInfo;
        } else {
            header("Location: /");
        }
    }

    public function getUser()
    {

        if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {

            $email = (string)$_GET["email"];
            $userInfo = (new User)->getUser($email);
            return $userInfo;

            echo $_GET["userID"];
        } else {
            header("Location: /");
        }
    }


    public function postCama()

    {
        if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {
            $userType = $_SESSION["user_type"];

            if ($userType === "empleado") {
                $numero = (int)$_GET["cama_numero"];
                $temperatura = (float)$_POST["temperatura"];
                $humedad = (float)$_POST["humedad"];
                $ph = (float)$_POST["ph"];
                $fecha = date("Y/m/d");
                $userId = (int)$_SESSION["userId"]; //remplazar con $cookies["userid"]

                $nuevaCama = (new Cama())->postCama($numero, $temperatura, $humedad, $ph, $fecha, $userId);
                header("Location: /dashboard");
            } else {
                header("Location: /");
            }
        } else {
            header("Location: /");
        }
    }

    public function editCama()
    {
        if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {
            $userType = $_SESSION["user_type"];

            if ($userType === "empleado") {
                $numero = (int)$_GET["cama_numero"];
                $temperatura = (float)$_POST["temperatura"];
                $humedad = (float)$_POST["humedad"];
                $ph = (float)$_POST["ph"];
                $userId = (int)$_SESSION["userId"];

                $nuevaCama = (new Cama())->editCama($numero, $temperatura, $humedad, $ph, $userId);

                header("Location: /dashboard");
            }else {
                header("Location: /");
            }
        } else {
            header("Location: /");
        }
    }

    public function logout()
    {
        $destroy = session_destroy();
        if ($destroy) {
            echo "<script> window.location.href='http://212.24.110.50:3000/' </script>";
        }
    }
}
