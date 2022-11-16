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
    $query = $db->query("SELECT tb_order.id, nombre, lastname, pay, FROM_UNIXTIME(date_order,'%m/%d/%Y') as date_orden, date_okay  FROM tb_order JOIN tb_estudiante ON tb_estudiante.id = fk_estudiante WHERE `condition`= 0 ORDER BY tb_order.id DESC");
    return $query->getResultArray();
  }

  function ventas()
  {
    $db = \Config\Database::connect();
    $query = $db->query("SELECT pay FROM tb_order WHERE `condition` = 1");
    return $query->getResultArray();
  }

  function getOrders()
  {
    $db = \Config\Database::connect();
    $query = $db->query("SELECT tb_order.id, FROM_UNIXTIME(tb_order.date_order, '%d %M %Y') as fecha_solicitud, tb_estudiante.nombre, tb_estudiante.lastname, tb_order.pay, tb_order.condition, FROM_UNIXTIME(tb_order.date_okay, '%d %M %Y') as fecha_aprobado, libros_id FROM `tb_order` JOIN tb_estudiante ON tb_estudiante.id = tb_order.fk_estudiante ORDER BY tb_order.id DESC");
    return $query->getResultArray();
  }

  function getOrdersID($id)
  {
    $db = \Config\Database::connect();
    $query = $db->query("SELECT tb_order.id, FROM_UNIXTIME(tb_order.date_order, '%d %M %Y') as fecha_solicitud, tb_estudiante.nombre, tb_estudiante.lastname, tb_order.pay, tb_order.condition, FROM_UNIXTIME(tb_order.date_okay, '%d %M %Y') as fecha_aprobado, libros_id FROM `tb_order` JOIN tb_estudiante ON tb_estudiante.id = tb_order.fk_estudiante  WHERE tb_order.fk_estudiante = '$id' ORDER BY tb_order.id DESC");
    return $query->getResultArray();
  }

  function update_order($id, $date)
  {
    $db = \Config\Database::connect();
    $query = $db->query("UPDATE tb_order SET date_okay ='$date', `condition`= 3  WHERE id = '$id'");
    return $query;
  }

  function upd_order_status($id)
  {
    $db = \Config\Database::connect();
    $query = $db->query("UPDATE tb_order SET `condition` = 2  WHERE id = '$id'");
    return $query;
  }

  function getDateOrder($id)
  {
    $db = \Config\Database::connect();
    $query = $db->query("SELECT date_order FROM tb_order WHERE id = '$id'");
    return $query->getRowArray();
  }

  function getDateOk($id)
  {
    $db = \Config\Database::connect();
    $query = $db->query("SELECT date_okay FROM tb_order WHERE id = '$id'");
    return $query->getRowArray();
  }

  function upd_payeer($id)
  {
    $db = \Config\Database::connect();
    $query = $db->query("UPDATE tb_order SET `condition` = 1  WHERE id = '$id'");
    return $query;
  }

  function getFechaOk($id)
  {
    $db = \Config\Database::connect();
    $query = $db->query("SELECT `condition` FROM tb_order WHERE id = '$id'");
    return $query->getRowArray();
  }

  function getOrderStudents()
  {
    $db = \Config\Database::connect();
    $query = $db->query("SELECT DISTINCT fk_estudiante, nombre, lastname as estudiante FROM tb_order JOIN tb_estudiante ON tb_estudiante.id = tb_order.fk_estudiante WHERE `condition` = 1 limit 5 ");
    return $query->getResultArray();
  }

  function totalPayOrStudent($id)
  {
    $db = \Config\Database::connect();
    $query = $db->query("SELECT SUM(pay) as payTotal FROM tb_order WHERE fk_estudiante = '$id' AND `condition` = 1");
    return $query->getRowArray();
  }
  function getBooksOrders()
  {
    $db = \Config\Database::connect();
    $query = $db->query("SELECT libros_id as libros FROM tb_order WHERE `condition` = 1");
    return $query->getResultArray();
  }
}
