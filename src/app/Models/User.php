<?php

declare(strict_types=1);
namespace App\Models;

use App\Model;

class User extends Model{

    public function createUser(string $name, string $email, string $username){
        $db_1 = $this->db;
        $query = "INSERT INTO Users(name, email , username)
        VALUES($name,$email,$username )
        ";
        $stmt = $db_1->prepare($query);
        $stmt->execute();
        //var_dump($stmt->fetch());

    }

    public function getAllUsers():array{
        $db_1 = $this->db;
        $query = "SELECT * FROM Users";
        $stmt = $db_1->prepare($query);
        $stmt->execute();
        return($stmt->fetchAll());
    }

    public function getAllUsersJson(){
        $db_1 = $this->db;
        $query = "SELECT * FROM Users";
        $stmt = $db_1->prepare($query);
        $stmt->execute();
        
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        //echo json_encode($results);
        return json_encode($results);
    }

    public function getUser(string $email){

        $db_1 = $this->db;
        $query = "SELECT * FROM Users WHERE email='$email'" ;
        $stmt = $db_1->prepare($query);
        $stmt->execute();

        //$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        //echo json_encode($results);
        //return json_encode($results);

       return($stmt->fetch());
    }

    public function getUserByUsername(string $username){

        $db_1 = $this->db;
        $query = "SELECT * FROM Users WHERE username='$username'" ;
        $stmt = $db_1->prepare($query);
        $stmt->execute();

       return($stmt->fetch());
    }


    public function loginUser(string $email, string $password=null){
        //$allUsers= $this->getAllUsers();
        return $this->getUser($email);

    }

    public function registerUser(string $email, string $name, string $username,
    string $userType,  string $password){
        
        $db_1 = $this->db;
        
        $query = 'INSERT INTO Users(email,name,username,password,user_type)
        VALUES(:email, :name, :username,:password,:user_type)';

        $stmt = $db_1->prepare($query);

        $stmt->execute([
            'email'=>$email,
            'name'=>$name,
            'username'=>$username,
            'password'=>$password,
            'user_type'=>$userType,
        ]);

        $stmt->fetch();
        
        header('Location: /login');

    }

    public function sendContactForm(string $nombre,string $email, string $numero,
     string $pais, string $mensaje, $fecha){

        $db_1 = $this->db;
        
        $query = 'INSERT INTO Mensajes(nombre,email,numero,pais,mensaje,fecha)
        VALUES(:nombre, :email, :numero, :pais, :mensaje, :fecha)';

        $stmt = $db_1->prepare($query);

        $stmt->execute([
            "nombre"=>$nombre,
            "email"=>$email,
            "numero"=>$numero,
            "pais"=>$pais,
            "mensaje"=>$mensaje,
            "fecha"=>$fecha
        ]);

        $stmt->fetch();

        
        header('Location: /');
    }


}