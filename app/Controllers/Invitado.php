<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Invitado extends Controller
{
    public function index()
    {
        session_start();
        if (!isset($_SESSION['rol'])) {
            return redirect()->to(base_url() . '/');
        } else
        if ($_SESSION['rol'] != 3) {
            return redirect()->to(base_url() . '/');
        }
        return view('User/usuario');
    }
}
