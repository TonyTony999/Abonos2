<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;

class Categoria extends Model
{

    public function getCategorias()
    {
        $db_1 = $this->db;
        $query = "SELECT * FROM categorias";
        $stmt = $db_1->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function postCategoria(string $titulo, string $descripcion)
    {
        $db_1 = $this->db;
        $query = "INSERT INTO categorias (titulo,descripcion) 
        VALUES (:titulo,:descripcion)";
        $stmt = $db_1->prepare($query);

        $stmt->execute([
            'titulo' => $titulo,
            'descripcion' => $descripcion
        ]);

        $results = $stmt->fetch();
        return $results;


    }


    public function deleteCategoria($categoriaTitulo){
        $db_1 = $this->db;
        $query = "DELETE FROM categorias WHERE titulo = '$categoriaTitulo'";
        $stmt = $db_1->prepare($query);
        $stmt->execute();

        $results = $stmt->fetch();

    }
}