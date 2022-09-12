<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

class Colab extends Controller{
    public function index()
    {
        return view('Colaborador/colab');
    }
}