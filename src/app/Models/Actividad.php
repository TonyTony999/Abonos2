<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;

class Actividad extends Model
{

    public function postActividad(string $titulo, string $fechaInicial,
    string $fechaFinal,string $encargado,int $user_id, string $descripcion, string $estado)
    {
        $db_1 = $this->db;
        $query = "INSERT INTO actividades (titulo,fecha_inicial, fecha_final,encargado,
        user_id, descripcion, estado) 
        VALUES (:titulo, :fecha_inicial, :fecha_final,:encargado, :user_id, :descripcion, :estado)";
        $stmt = $db_1->prepare($query);

        $stmt->execute([
            'titulo' => $titulo,
            'fecha_inicial' => $fechaInicial,
            'fecha_final' => $fechaFinal,
            'encargado'=>$encargado,
            'user_id' => $user_id,
            'descripcion' => $descripcion,
            'estado' => $estado
        ]);

        $results = $stmt->fetch();
        return $results;


    }

    public function getActividades()
    {
        $db_1 = $this->db;
        $query = "SELECT * FROM actividades";
        $stmt = $db_1->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getActividadesByUserId($userId)
    {
        $db_1 = $this->db;
        $query = "SELECT * FROM actividades WHERE user_id=$userId";
        $stmt = $db_1->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function editEstadoActividad($actividadId,$actividadEstado){

        $db_1 = $this->db;
        $query = "UPDATE actividades
        SET estado = '$actividadEstado' WHERE id=$actividadId";
        $stmt = $db_1->prepare($query);
        $stmt->execute();
        return $stmt->fetch();

    }

    public function deleteActividad($actividadId){

        $db_1 = $this->db;
        $query = "DELETE FROM actividades WHERE id ='$actividadId'";
        $stmt = $db_1->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();

    }


}