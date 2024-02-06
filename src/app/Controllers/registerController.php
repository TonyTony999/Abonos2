<?php

declare(strict_types=1);

namespace App\Controllers;

use App\App;
use App\View;
use App\Models\User;
use Ramsey\Uuid\Uuid;

class registerController
{

    public function index()
    {

        $view = new View("Register", "/styles/registerStyle.css");
        return $view->render();
    }

    public function registerUser()
    {

        
        $name = $_POST["name"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $userType = $_POST["user-type"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];

        $hashedPass=password_hash($password, PASSWORD_DEFAULT);
        $emailExists = (new User())->getUser($email);

        $info=[
            "name"=>$name,
            "email"=>$email,
            "username"=>$username,
            "usertype"=>$userType,
            "password"=>$password,
            "password2"=>$password2
        ];
        
        //echo (string)$password === (string)$password2;
       // print_r($info);

        
        if (!$emailExists) {
            if((string)$password === (string)$password2){
                (new User())->registerUser($email,$name,$username, $userType, $hashedPass);

            }else{
                header("Location: /register");
            }
            
        }else{
            header("Location: /login");
        }
        
    }
}
