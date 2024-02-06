<?php

declare(strict_types=1);

namespace App\Controllers;

use App\App;
use App\Models\User;
use Exception;
use Ramsey\Uuid\Nonstandard\Uuid;

class formController
{

    public function submitContactForm() {

        $nombre= $_POST["nombre"];
        $email = $_POST["email"];
        $numero = $_POST["numero"];
        $pais = $_POST["pais"];
        $mensaje = $_POST["mensaje"];
        $fecha= date("Y/m/d");

        $info=[
            "name"=>$nombre,
            "email"=>$email,
            "numero"=>$numero,
            "pais"=>$pais,
            "mensaje"=>$mensaje
        ];

        sleep(2);
        (new User)->sendContactForm($nombre, $email, $numero, $pais, $mensaje, $fecha);

        
    }


}