<?php

namespace App\Models;

use CodeIgniter\Model;

class M_book extends Model
{
    protected $table      = 'tb_libro';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'codigo',
        'titulo',
        'portada',
        'precio',
        'autor',
        'isbn',
        'cantidad'
    ];

    function guardar($codigo, $titulo, $precio, $autor, $isbn, $cantidad, $newName)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_libro');
        $data = [
            'codigo' => $codigo,
            'titulo' => $titulo,
            'portada' => $newName,
            'precio' => $precio,
            'autor' => $autor,
            'isbn' => $isbn,
            'cantidad' => $cantidad
        ];
        return $builder->insert($data);
    }

    function row_preport($codigo)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM tb_libro WHERE codigo = '$codigo'");
        return $query;
    }

    function list_book()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT id as id_book, portada, codigo, titulo, precio, autor, isbn, cantidad FROM tb_libro");
        return $query->getResultArray();
    }    

    function update_book($id, $codigo, $titulo, $precio, $autor, $isbn, $cantidad)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_libro');
        $data = [
            'codigo' => $codigo,
            'titulo' => $titulo,
            'precio' => $precio,
            'autor' => $autor,
            'isbn' => $isbn,
            'cantidad' => $cantidad
        ];
        $builder->where('id', $id);
        return $builder->update($data);
    }

    function del_book($id_libro)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_libro');
        $builder->where('id', $id_libro);
        return $builder->delete();
    }

    function getBook()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM tb_libro WHERE cantidad > 0 ORDER BY id DESC");
        return $query->getResultArray();
    }

    function descontar($fk_libro)
    {
        $db = \Config\Database::connect();
        $query = $db->query("UPDATE tb_libro SET cantidad=cantidad-1 WHERE id = '$fk_libro'");
        return $query;
    }
    function restarForDispo($fk_libro, $c_disponibles)
    {
        $db = \Config\Database::connect();
        $query = $db->query("UPDATE tb_libro SET cantidad=cantidad-'$c_disponibles' WHERE id = '$fk_libro'");
        return $query;
    }

    function contar($idBook)
    {
        $db = \Config\Database::connect();
        $query = $db->query("UPDATE tb_libro SET cantidad=cantidad+1 WHERE id = '$idBook'");
        return $query;
    }
    function cantIdBook($fk_libro)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT cantidad FROM tb_libro WHERE id = '$fk_libro'");
        return $query->getRowArray();
    }

    function libroID($id)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM tb_libro WHERE id = '$id'");
        return $query->getRowArray();
    }
}
