<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Invitado extends Controller
{
    public function index()
    {
        return view('User/usuario');
    }
}
