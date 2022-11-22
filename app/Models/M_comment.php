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

  function getComments()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT ci, nombre, lastname, `subject`, comment FROM tb_comment JOIN tb_estudiante ON tb_estudiante.id = tb_comment.fk_estudiante ORDER BY tb_comment.id DESC");
        return $query->getResultArray();
    }
}