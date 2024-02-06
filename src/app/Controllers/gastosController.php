<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use App\Models\User;
use App\Models\Gasto;
use App\Models\Categoria;
use App\Navbar;

use Exception;

class gastosController
{

    public function index()
    {

        if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {
            $userType = $_SESSION["user_type"];

            if ($userType === "administrador") {
                $navbar= (new Navbar)->render($userType);
                $userInfo = $_SESSION["username"];
                $categorias = (new Categoria)->getCategorias();
                $gastosCurrentMonth = (new Gasto)->getGastosThisMonth();
                $dbData = ["userInfo" => $userInfo, "gastosCurrentMonth" => $gastosCurrentMonth, "categorias" => $categorias, "navbar"=>$navbar];

                $view = new View("Gastos", "/styles/gastosStyle.css", $dbData);

                return $view->render();
            } else {
                header("Location: /");
            }
        } else {
            header("Location: /");
        }
    }

    public function submitGasto()
    {

        if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {
            $userType = $_SESSION["user_type"];

            if ($userType === "administrador") {
                $titulo = $_POST["titulo"];
                $fecha = $_POST["fecha"];

                $fecha = explode("/", $fecha);
                $fecha = $fecha[2] . "-" . $fecha[0] . "-" . $fecha[1];

                $destinatario = $_POST["destinatario"];
                $categoria = $_POST["categoria"];
                $user = (new User)->getUserByUsername($_SESSION["username"]);
                $user_id = (int)$user["id"];
                $descripcion = $_POST["descripcion"];
                $valor = (float)$_POST["valor"];

                (new Gasto)->postGasto($titulo, $fecha, $destinatario, $categoria, $user_id, $descripcion, $valor);

                header("Location: /gastos");
            } else {
                header("Location: /");
            }
        } else {
            header("Location: /");
        }
    }

    public function editGasto()
    {

        if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {
            $userType = $_SESSION["user_type"];
            if ($userType === "administrador") {

                $gastoId = (int)$_GET["gastoId"];

                $titulo = $_POST["titulo"];

                $destinatario = $_POST["destinatario"];
                $categoria = $_POST["categoria"];
                $user = (new User)->getUserByUsername($_SESSION["username"]);
                $user_id = (int)$user["id"];
                $descripcion = $_POST["descripcion"];
                $valor = (float)$_POST["valor"];

                (new Gasto)->editGasto(
                    titulo: $titulo,
                    destinatario: $destinatario,
                    categoria: $categoria,
                    descripcion: $descripcion,
                    valor: $valor,
                    gastoId: $gastoId
                );

                header("Location: /gastos");
            } else {
                header("Location: /");
            }
        } else {
            header("Location: /");
        }
    }

    public function deleteGasto()
    {

        if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {
            $userType = $_SESSION["user_type"];
            if ($userType === "administrador") {
                $gastoId = (int)$_GET["gastoId"];
                //echo "deleteed";
                (new Gasto)->deleteGasto($gastoId);

                header("Location: /gastos");
            }else {
                header("Location: /");
            }
            
        } else {
            header("Location: /");
        }
    }
}
