<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Categoria;

use Exception;

class categoriasController
{

    public function submitCategoria()
    {

        if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {
            $userType = $_SESSION["user_type"];

            if ($userType === "administrador") {

                $titulo = $_POST["titulo"];
                $descripcion = $_POST["descripcion"];

                (new Categoria)->postCategoria($titulo, $descripcion);

                header("Location: /gastos");
            } else {
                header("Location: /");
            }
        } else {
            header("Location: /");
        }
    }

    public function deleteCategoria()
    {
        if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {
            $userType = $_SESSION["user_type"];

            if ($userType === "administrador") {
                $categoriaTitulo = $_POST["categoria"];

                (new Categoria)->deleteCategoria($categoriaTitulo);

                header("Location: /gastos");
            }else {
                header("Location: /");
            }

        } else {
            header("Location: /");
        }
    }
}
