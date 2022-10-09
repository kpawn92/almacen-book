<?php

namespace App\Models;

use CodeIgniter\Model;

class M_orders extends Model
{
  protected $table      = 'tb_order';
  // Uncomment below if you want add primary key
  protected $primaryKey = 'id';

  function guardar($fk_estudiante, $libros_id, $pay, $date_order)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('tb_order');
    $data = [
      'fk_estudiante' => $fk_estudiante,
      'libros_id' => $libros_id,
      'pay' => $pay,
      'date_order' => $date_order
    ];
    return $builder->insert($data);
  }

  function row_preport($estudiante)
  {
    $db = \Config\Database::connect();
    $query = $db->query("SELECT * FROM tb_order WHERE fk_estudiante = '$estudiante' AND `condition`= 0");
    return $query;
  }

  function getOrdenNotif()
  {
    $db = \Config\Database::connect();
    $query = $db->query("SELECT tb_order.id, nombre, lastname, pay, FROM_UNIXTIME(date_order,'%m/%d/%Y') as date_orden, date_okay  FROM tb_order JOIN tb_estudiante ON tb_estudiante.id = fk_estudiante WHERE `condition`= 0");
    return $query->getResultArray();
  }
  
  
}
