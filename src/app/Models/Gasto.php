<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;

class Gasto extends Model
{

    public function postGasto(string $titulo, string $fecha ,string $destinatario,string $categoria, int $user_id, string $descripcion, float $valor)
    {
        $db_1 = $this->db;
        $query = "INSERT INTO gastos (titulo,fecha,destinatario,categoria,user_id,descripcion,valor) 
        VALUES (:titulo,:fecha,:destinatario,:categoria,:user_id,:descripcion,:valor)";
        $stmt = $db_1->prepare($query);

        $stmt->execute([
            'titulo' => $titulo,
            'fecha' => $fecha,
            'destinatario'=>$destinatario,
            'categoria'=>$categoria,
            'user_id' => $user_id,
            'descripcion' => $descripcion,
            'valor' => $valor
        ]);

        $results = $stmt->fetch();
        return $results;


    }

    public function getGastos()
    {
        $db_1 = $this->db;
        $query = "SELECT * FROM gastos";
        $stmt = $db_1->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getGastosThisMonth(){
        $db_1 = $this->db;
        
        $currentDate=date("Y/m/d");
        $currentDateArr=explode("/", $currentDate);
        $currentMonth=$currentDateArr[1];
        $firstDayOfCurrentMonth="2024/$currentMonth/1";
        

        $previousMonthTimestamp = strtotime("-1 month");
        $previousMonth=date('Y/m/d', $previousMonthTimestamp);
        $query = "SELECT * FROM gastos WHERE CAST(fecha AS Date) >= '$firstDayOfCurrentMonth'";
        //SELECT * FROM camas WHERE CAST(fecha AS Date) >= '2023-01-02';
        $stmt = $db_1->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function editGasto(string $titulo ,string $destinatario,string $categoria,
      string $descripcion, float $valor, int $gastoId){

        $db_1 = $this->db;
        $query = "UPDATE gastos
        SET titulo= '$titulo', destinatario ='$destinatario', categoria='$categoria', descripcion='$descripcion', valor='$valor'
        WHERE id=$gastoId; 
        ";
        $stmt = $db_1->prepare($query);
        $stmt->execute();

        $results = $stmt->fetch();
        //return $results;


    }

    public function deleteGasto($gastoId){
        $db_1 = $this->db;
        $query = "DELETE FROM gastos WHERE id =$gastoId";
        $stmt = $db_1->prepare($query);
        $stmt->execute();

        $results = $stmt->fetch();

        

    }
}