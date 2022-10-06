<?php

namespace App\Models;

use CodeIgniter\Model;

class M_users extends Model
{
    protected $table      = 'tb_users';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';

    function createUser($ci)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_users');
        $data = [
            'password' => $ci
        ];
        return $builder->insert($data);
    }

    function del_user($ci)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_users');       
        $builder->where('password', $ci);
        return $builder->delete();
    }
}
