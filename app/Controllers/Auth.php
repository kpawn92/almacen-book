<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_users;
use PDO;

class Auth extends Controller
{
    public function index()
    {
        session_start();
        if (isset($_SESSION['rol'])) {
            switch ($_SESSION['rol']) {
                case 1:
                    return redirect()->to(base_url() . '/index');
                    break;
                case 2:
                    return redirect()->to(base_url() . '/colab');
                    break;
                case 3:
                    return redirect()->to(base_url() . '/user');
                    break;
                default:
            }
        } else
            return view('Auth/login');
    }
    public function acceder()
    {
        session_start();
        $request = \Config\Services::request();
        extract($request->getPost());

        if (isset($usuario) && isset($password)) {
            $db = \Config\Database::connect();
            $query = $db->query("SELECT*FROM tb_users WHERE usuario = '$usuario' AND password = '$password' AND logged != 2"); //logged === 2 user cancelado
            $row = $query->getRowArray();

            if ($row == true) {
                $id = intval($row['id']);
                $rol = intval($row['rol']);
                $_SESSION['rol'] = $rol;
                $_SESSION['id'] = $id;

                if (isset($_SESSION['rol'])) {
                    switch ($_SESSION['rol']) {
                        case 1:
                            return redirect()->to(base_url() . '/index');
                            break;
                        case 2:
                            return redirect()->to(base_url() . '/colab');
                            break;
                        case 3:
                            return redirect()->to(base_url() . '/user');
                            break;
                        default:
                    }
                }
            } else {
                session_unset();
                session_destroy();
                return redirect()->back();
            }
        }
    }

    public function salir()
    {
        session_start();
        session_unset();
        session_destroy();
        return redirect()->to(base_url() . '/');
    }
}
