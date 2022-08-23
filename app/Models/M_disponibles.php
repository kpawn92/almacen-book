<?php

namespace App\Models;

use CodeIgniter\Model;

class M_disponibles extends Model
{
    protected $table      = 'op_books_disponibles';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';

    function saveDatos($fk_libro, $c_disponibles)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('op_books_disponibles');
        $data = [
            'fk_libro' => $fk_libro,
            'c_disponibles' => $c_disponibles
        ];
        return $builder->insert($data);
    }

    function librosDispo()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT DISTINCT titulo, precio, c_disponibles FROM op_books_disponibles JOIN tb_libro ON tb_libro.id = fk_libro ORDER BY op_books_disponibles.id DESC");
        return $query->getResultArray();
    }
    function comprobation($fk_libro)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT id, fk_libro, c_disponibles FROM op_books_disponibles WHERE fk_libro = '$fk_libro'");
        return $query;
    }
    function actualizarCant($id, $c_disponibles)
    {
        $db = \Config\Database::connect();
        $query = $db->query("UPDATE op_books_disponibles SET c_disponibles = c_disponibles + '$c_disponibles' WHERE id = '$id'");
        return $query;
    }
}
