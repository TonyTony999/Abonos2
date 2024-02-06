<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;

class Mensajes extends Model
{

    public function getMensajes()
    {
        $db_1 = $this->db;
        /*$query = "SELECT * FROM Mensajes";*/
        $query="SELECT * FROM `Mensajes` ORDER BY `Mensajes`.`fecha` DESC";
        $stmt = $db_1->prepare($query);
        $stmt->execute();

        $results = $stmt->fetchAll();

        return $results;
    }

    public function getMensaje($id){
        $db_1 = $this->db;
        /*$query = "SELECT * FROM Mensajes";*/
        $query="SELECT * FROM `Mensajes` WHERE id=$id ";
        $stmt = $db_1->prepare($query);
        $stmt->execute();

        $results = $stmt->fetch();

        return $results;

    }

}