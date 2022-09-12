<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_municipios;
use App\Models\M_carrera;
use App\Models\M_yearA;
use App\Models\M_brigada;
use App\Models\M_student;
use App\Models\M_book;

class Dash extends Controller
{
    public function index()
    {
        session_start();
        if (!isset($_SESSION['rol'])) {
            return redirect()->to(base_url() . '/');
        } else
        if ($_SESSION['rol'] != 1) {
            return redirect()->to(base_url() . '/');
        }
        $municipios = new M_municipios();
        $dato['municipios'] = $municipios->orderBy('id')->findAll();
        $carreras = new M_carrera();
        $dato['carreras'] = $carreras->orderBy('id')->findAll();
        $year = new M_yearA();
        $dato['academias'] = $year->orderBy('id')->findAll();
        $brigada = new M_brigada();
        $dato['brigadas'] = $brigada->orderBy('id')->findAll();
        $estudiante = new M_student();
        $dato['estudiantes'] = $estudiante->orderBy('id')->findAll();
        return view('template/main', $dato);
    }

    public function save_student()
    {
        $request = \Config\Services::request();
        $validation = $this->validate([
            'nombre' => 'required|min_length[1]|max_length[50]|alpha_space',
            'lastname' => 'required|min_length[1]|max_length[50]|alpha_space',
            'ci' => 'required|is_natural|min_length[11]|max_length[11]|numeric',
            'direccion' => 'required'
        ]);

        if (!$validation) {
            $confirm  = $this->validator;
            return $confirm->listErrors();
        } else {
            extract($request->getPost());
            $student = new M_student();
            $rows_report = $student->row_preport($ci);
            if ($rows_report->getNumRows() > 0) {
                echo 'El estudiante <strong>' . $nombre . ' ' . $lastname . '</strong> ya existe';
            } else {
                $student->guardar($ci, $nombre, $lastname, $direccion, $fk_municipio, $fk_carrera, $fk_year_academico, $fk_brigada);
                echo "<strong>Datos guardados correctamente...</strong>";
            }
        }
    }

    public function edit_student()
    {
        $request = \Config\Services::request();
        $validation = $this->validate([
            'nombre' => 'required|min_length[1]|max_length[50]|alpha_space',
            'lastname' => 'required|min_length[1]|max_length[50]|alpha_space',
            'ci' => 'required|is_natural|min_length[11]|max_length[11]|numeric',
            'direccion' => 'required'
        ]);

        if (!$validation) {
            $confirm  = $this->validator;
            return $confirm->listErrors();
        } else {
            extract($request->getPost());
            $student = new M_student();
            $act = $student->update_student($id, $nombre, $lastname, $ci, $direccion, $fk_municipio, $fk_carrera, $fk_year_academico, $fk_brigada);
            if ($act == false) {
                echo "Error de actualizaci&oacute;n";
            } else echo "<strong>Datos actualizados correctamente...</strong>";
        }
    }

    public function del_student()
    {
        $request = \Config\Services::request();
        $student = new M_student();
        extract($request->getPost());
        $query1 = $student->del_student($id);
        if ($query1 != true) {
            echo "false";
        } else echo "true";
    }


    public function list_student()
    {
        $estudiantes = new M_student();
        if ($_POST['funcion'] == "listar") {
            $json = array();
            $student = $estudiantes->listar_stud();

            foreach ($student as $data) {
                $json['data'][] = $data;
            }
            $jsonstring = json_encode($json);
            echo $jsonstring;
        }
    }

    public function save_book()
    {
        //echo "preparando el guardar libro";
        $request = \Config\Services::request();

        $validation = $this->validate([
            'codigo' => 'required',
            'titulo' => 'required',
            'precio' => 'required',
            'autor' => 'required',
            'isbn' => 'required',
            'cantidad' => 'required'
        ]);

        if (!$validation) {
            $confirmBook  = $this->validator;
            return $confirmBook->listErrors();
        } else {
            extract($request->getPost());

            $book = new M_book();
            $rows_report = $book->row_preport($codigo);
            if ($rows_report->getNumRows() > 0) {
                echo 'El libro <strong>' . $titulo . '</strong> ya existe';
            } else {
                $book->guardar($codigo, $titulo, $precio, $autor, $isbn, $cantidad);
                echo "<strong>Datos guardados correctamente...</strong>";
            }
        }
    }

    public function list_book()
    {
        $libros = new M_book();
        if ($_POST['accion'] == "listarLibro") {
            $json = array();
            $book = $libros->list_book();

            foreach ($book as $data) {
                $json['data'][] = $data;
            }
            $jsonstring = json_encode($json);
            echo $jsonstring;
        }
    }

    public function edit_book()
    {
        $request = \Config\Services::request();
        $validation = $this->validate([
            'codigo' => 'required',
            'titulo' => 'required',
            'precio' => 'required',
            'autor' => 'required',
            'isbn' => 'required',
            'cantidad' => 'required'
        ]);

        if (!$validation) {
            $confirmBook  = $this->validator;
            return $confirmBook->listErrors();
        } else {
            extract($request->getPost());
            $book = new M_book();
            $act = $book->update_book($id, $codigo, $titulo, $precio, $autor, $isbn, $cantidad);
            if ($act == false) {
                echo "Error de actualizaci&oacute;n";
            } else echo "<strong>Datos actualizados correctamente...</strong>";
        }
    }

    public function del_book()
    {
        $request = \Config\Services::request();
        $book = new M_book();
        extract($request->getPost());
        $query1 = $book->del_book($id_libro);
        if ($query1 != true) {
            echo "false";
        } else echo "true";


        /*if ($query1 != true) {
            echo "El libro tiene registros pendientes";
        } else
            echo "El libro ha sido eliminado exitosamente"; */
    }

    public function ci()
    {
        $estudiante = new M_student();
        $student = $estudiante->orderBy('id', 'DESC')->findAll();
        foreach ($student as $std) :
            /* 
            echo '<option value="' . $std['id'] . '">' . $std['ci'] . '</option>'; */
            echo '<option>' . $std['ci'] . '</option>';
        endforeach;
    }
}
