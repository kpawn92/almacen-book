<?php 
namespace App\Models;

use CodeIgniter\Model;

class M_comment extends Model{
    protected $table      = 'tb_comment';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';

    function guardar($fk_estudiante, $subject, $comment)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('tb_comment');
    $data = [
      'fk_estudiante' => $fk_estudiante,
      'subject' => $subject,
      'comment' => $comment,
    ];
    return $builder->insert($data);
  }
}