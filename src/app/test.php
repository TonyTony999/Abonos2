<?php
require '../vendor/autoload.php';

use App\Models\Cama;

class populateCamas
{

    public function populate()
    {

        $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();

        $config = [

            'driver' => $_ENV['DB_DRIVER'],
            'user' => $_ENV['DB_USER'],
            'pass' => $_ENV['DB_PASS'],
            'database' => $_ENV['DB_DATABASE'],
            'host' => $_ENV['DB_HOST']

        ];

        $defaultOptions = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $db = new \PDO(
            $config["driver"] . ':host=' . $config["host"] . ";dbname=" . $config["database"],
            $config["user"],
            $config["pass"],
            $config["options"] ?? $defaultOptions
        );

        for ($i = 1; $i <= 10; $i++) {
            $i2 = (string)$i;
            $fecha = date("2024-01-$i2");
            for ($j = 1; $j <= 13; $j++) {

                $numero = $j;
                $temperatura = random_int(20, 35);
                $humedad = random_int(20, 35);
                $ph = random_int(0, 13);

                $query = "INSERT INTO camas (numero,temperatura,humedad,ph,fecha,userId) 
        VALUES (:numero, :temperatura, :humedad, :ph, :fecha, :userId)";
                $stmt = $db->prepare($query);

                $stmt->execute([
                    'numero' => $numero,
                    'temperatura' => $temperatura,
                    'humedad' => $humedad,
                    'ph' => $ph,
                    'fecha' => $fecha,
                    'userId' => 5
                ]);
            }
        }

        $results = $stmt->fetch();
        return $results;
    }

    public function populateGastos()
    {

        $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();

        $config = [

            'driver' => $_ENV['DB_DRIVER'],
            'user' => $_ENV['DB_USER'],
            'pass' => $_ENV['DB_PASS'],
            'database' => $_ENV['DB_DATABASE'],
            'host' => $_ENV['DB_HOST']

        ];

        $defaultOptions = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $db = new \PDO(
            $config["driver"] . ':host=' . $config["host"] . ";dbname=" . $config["database"],
            $config["user"],
            $config["pass"],
            $config["options"] ?? $defaultOptions
        );

        for ($i = 1; $i <= 30; $i++) {
            $i2 = (string)$i;
            $fecha = date("2023-12-$i2");

            $query = "INSERT INTO gastos (titulo,fecha,destinatario,categoria,user_id,descripcion,valor) 
        VALUES (:titulo,:fecha,:destinatario,:categoria,:user_id,:descripcion,:valor)";
                $stmt = $db->prepare($query);
                $categoria=["Yudy","Alba","Nicolas","Tractor","Otro"];
                $user_id=[29,30,69];

                $stmt->execute([
                    'titulo' => "titulo-".$i,
                    'fecha' => $fecha,
                    'destinatario' => "destinatario-".$i,
                    'categoria' => $categoria[random_int(0, 4)],
                    'user_id' => $user_id[random_int(0,2)],
                    'descripcion' => "descripcion-".$i,
                    'valor' => random_int(10000,300000)
                ]);
            
        }

        $results = $stmt->fetch();
        return $results;
    }
}



$pop = (new populateCamas())->populateGastos();
