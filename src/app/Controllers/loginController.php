<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use App\Models\User;
use Exception;

class loginController
{

    public function index()

    {
        if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {
            $userType = $_SESSION["user_type"];
            if ($userType === "administrador" || $userType === "asociado") {
                header("Location: /actividades");
            } else {
                header("Location: /dashboard");
            }
        } else {
            $view = new View("Login", "/styles/loginStyle.css");
            return $view->render();
        }
    }

    public function loginUser()
    {

        $email = $_POST["email"];
        $password = $_POST["password"];
        $user = (new User())->getUser($email);
        if ($user) {
            $hash = $user["password"];
            if (password_verify($password, $hash)) {

                $_SESSION["username"] = $user["username"];
                $_SESSION["email"] = $user["email"];
                $_SESSION["userId"] = $user["id"];
                $_SESSION["user_type"] = $user["user_type"];

                $cookieName = "email";
                $cookieValue = $email;
                $expiration = time() + 3600;
                setcookie($cookieName, $cookieValue, $expiration);

                if ($_SESSION["user_type"] === "empleado") {
                    header("Location: /dashboard");
                } else if ($_SESSION["user_type"] === "administrador") {
                    header("Location: /actividades");
                } else if ($_SESSION["user_type"] === "asociado") {
                    header("Location: /actividades");
                }
            } else {
                header("Location: /login");
            }
        } else {
            header("Location: /login");
        }
    }
}
