<?php

namespace App\Controllers;

use App\Models\M_student;
use App\Models\M_book;
use App\Models\M_entrega;

use CodeIgniter\Controller;

class Entrega extends Controller
{
    public function list_entrega()
    {
        if ($_POST["f"] == "listarEntregados") {
            //$id_estudiante = $_POST['ci'];
            //$ci = $_POST["f"];

            $librosEntregado = new M_entrega();

            $json = array();
            $books = $librosEntregado->list_bookEntregados();

            //print_r($books);

            foreach ($books as $data) {
                $json['data'][] = $data;
            }
            $jsonstring = json_encode($json);
            echo $jsonstring;
        }
    }

    public function book()
    {
        $libro = new M_book();
        $books = $libro->getBook();
        foreach ($books as $book) :
            echo '<option value="' . $book['id'] . '">' . $book['codigo'] . ' | ' . $book['titulo'] . '</option>';
        endforeach;
    }

    public function b_entregados()
    {
        $request = \Config\Services::request();
        extract($request->getPost());
        $entregados = new M_entrega();
        $student = $fk_estudiante;
        $books = $entregados->getBooks($student);
        foreach ($books as $book) :
            //echo '<option value="' . $book['id'] . '">' . $book['codigo'] . ' | ' . $book['titulo'] . '</option>';
            $json['data'][] = $book;
        endforeach;
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }

    public function save_entrega()
    {
        $request = \Config\Services::request();

        $validation = $this->validate([
            'fecha_entrega' => 'required'
        ]);

        if (!$validation) {
            $confirmBook  = $this->validator;
            return $confirmBook->listErrors();
        } else {
            extract($request->getPost());

            $sb = new M_entrega();
            $book = new M_book();
            $rows_report = $sb->row_preport($fk_estudiante, $fk_libro);
            if ($rows_report->getNumRows() > 0) {
                echo 'El estudiante ya posee el libro';
            } else {
                $date_entrega = strtotime($fecha_entrega);
                $book->descontar($fk_libro);
                $sb->guardar($fk_estudiante, $fk_libro, $date_entrega);

                echo "Datos guardados correctamente";
            }
        }
    }

    public function id_ci()
    {
        $student = new M_student();
        $request = \Config\Services::request();

        extract($request->getPost());

        $idCI = $student->id_ci($ci);

        echo $idCI['id'];
    }

    public function del_entrega()
    {
        $request = \Config\Services::request();
        $entrega = new M_entrega();
        extract($request->getPost());
        $entrega->del_entrega($id_entrega);
    }

    public function devolution()
    {
        /* $datos = $_POST['bookss'];
       print_r($datos); */
        $entrega = new M_entrega();

        $request = \Config\Services::request();
        extract($request->getPost());

        $date_devol = strtotime($date_dev);

        foreach ($bookss as $nArr => $dI) {
            if ($perdido == "false") {
                $entrega->actualizar(intval($dI), $date_devol);
            } else
                $entrega->updateEstado(intval($dI), $date_devol);
        }
        echo "Registro actualizado!" . $perdido;
    }
}
