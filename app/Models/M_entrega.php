<?php

namespace App\Models;

use CodeIgniter\Model;

class M_entrega extends Model
{
    protected $table      = 'op_historial_libroestudiante';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['fk_estudiante', 'fk_libro', 'date_entrega', 'date_devol', 'status'];

    function row_preport($fk_estudiante, $fk_libro)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM op_historial_libroestudiante WHERE fk_estudiante = '$fk_estudiante' AND fk_libro = '$fk_libro' AND `status`= 1");
        return $query;
    }

    function guardar($fk_estudiante, $fk_libro, $date_entrega)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('op_historial_libroestudiante');
        $data = [
            'fk_estudiante' => $fk_estudiante,
            'fk_libro' => $fk_libro,
            'date_entrega' => $date_entrega,
            'status' => 1
        ];
        return $builder->insert($data);
    }
    function list_bookEntregados()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT op_historial_libroestudiante.id, ci, tb_libro.codigo, tb_libro.titulo, FROM_UNIXTIME(date_entrega,'%m-%d-%Y') as fecha_entrega, FROM_UNIXTIME(date_devol,'%m-%d-%Y')as fecha_dev FROM op_historial_libroestudiante JOIN tb_libro ON tb_libro.id = fk_libro JOIN tb_estudiante ON tb_estudiante.id = op_historial_libroestudiante.fk_estudiante");
        return $query->getResultArray();
    }
    function getBooks($student)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT op_historial_libroestudiante.id, CONCAT(codigo, ' | ', titulo) `text` FROM op_historial_libroestudiante JOIN tb_libro ON tb_libro.id = op_historial_libroestudiante.fk_libro WHERE fk_estudiante = '$student' AND `status`= 1 ORDER BY op_historial_libroestudiante.date_entrega DESC");
        return $query->getResultArray();
    }
    function del_entrega($id_entrega)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('op_historial_libroestudiante');
        $builder->where('id', $id_entrega);
        return $builder->delete();
    }

    function actualizar($dI, $date_devol)
    {
        $db = \Config\Database::connect();
        $query = $db->query("UPDATE op_historial_libroestudiante SET date_devol='$date_devol', `status`= 2  WHERE id = '$dI'");
        return $query;
    }
    function updateEstado($dI, $date_devol)
    {
        $db = \Config\Database::connect();
        $query = $db->query("UPDATE op_historial_libroestudiante SET date_devol='$date_devol', `status`= 3  WHERE id = '$dI'");
        return $query;
    }

    function getIdBook($dI)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT fk_libro, date_entrega, tb_libro.titulo FROM op_historial_libroestudiante JOIN tb_libro ON tb_libro.id = fk_libro WHERE op_historial_libroestudiante.id = '$dI'");
        return $query->getRowArray();
    }
}
