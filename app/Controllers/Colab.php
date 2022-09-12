<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Colab extends Controller
{
    public function index()
    {
        session_start();
        if (!isset($_SESSION['rol'])) {
            return redirect()->to(base_url() . '/');
        } else
        if ($_SESSION['rol'] != 2) {
            return redirect()->to(base_url() . '/');
        }
        return view('Colaborador/colab');
    }
}
