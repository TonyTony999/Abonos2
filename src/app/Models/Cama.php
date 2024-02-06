<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;

class Cama extends Model
{

    public function postCama(int $numero, float
     $temperatura, float $humedad, float $ph, string $fecha, int $userId)
    {
        $db_1 = $this->db;
        $query = "INSERT INTO camas (numero,temperatura,humedad,ph,fecha,userId) 
        VALUES (:numero, :temperatura, :humedad, :ph, :fecha, :userId)";
        $stmt = $db_1->prepare($query);

        $stmt->execute([
            'numero' => $numero,
            'temperatura' => $temperatura,
            'humedad' => $humedad,
            'ph' => $ph,
            'fecha' => $fecha,
            'userId' => $userId
        ]);

        $results = $stmt->fetch();
        return $results;
    }

    public function getCamas()
    {
        $db_1 = $this->db;
        $query = "SELECT * FROM camas";
        $stmt = $db_1->prepare($query);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getCamasHoy()
    {

        $db_1 = $this->db;
        $currentDate = date("Y/m/d");
        $currentDate = str_replace("/", "-", $currentDate);
        $query = "SELECT * FROM camas WHERE fecha = '$currentDate'";
        $stmt = $db_1->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getCamasLastWeek()
    {
        $db_1 = $this->db;
        /*
        $currentDate=date("Y/m/d");
        $currentDate= str_replace("/","-",$currentDate);
        */

        $previousWeekTimestamp = strtotime("-1 week");
        $previousWeek=date('Y/m/d', $previousWeekTimestamp);
        $query = "SELECT * FROM camas WHERE CAST(fecha AS Date) >= '$previousWeek'";
        //SELECT * FROM camas WHERE CAST(fecha AS Date) >= '2023-01-02';
        $stmt = $db_1->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getCamasLastMonth()
    {
        $db_1 = $this->db;
        /*
        $currentDate=date("Y/m/d");
        $currentDate= str_replace("/","-",$currentDate);
        */

        $previousMonthTimestamp = strtotime("-1 month");
        $previousMonth=date('Y/m/d', $previousMonthTimestamp);
        $query = "SELECT * FROM camas WHERE CAST(fecha AS Date) >= '$previousMonth'";
        //SELECT * FROM camas WHERE CAST(fecha AS Date) >= '2023-01-02';
        $stmt = $db_1->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getCamasDia($dia)
    {

        $db_1 = $this->db;
        $currentDate = date("Y/m/d");
        $currentDate = str_replace("/", "-", $dia);
        $query = "SELECT * FROM camas WHERE fecha = '$currentDate'";
        $stmt = $db_1->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }


    public function editCama(int $numero, float $temperatura, float $humedad, float $ph, int $userId)
    {
        $db_1 = $this->db;
        $query = "UPDATE camas
        SET temperatura = ?, humedad= ?, ph=?, userId=? WHERE numero = ?";

        $stmt = $db_1->prepare($query);
        $stmt->execute([$temperatura, $humedad, $ph, $userId, $numero]);

        return $stmt->fetch();
    }
}
