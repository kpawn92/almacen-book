<?php

namespace App\Controllers;

use App\Models\M_student;
use App\Models\M_book;
use App\Models\M_entrega;
use App\Models\M_disponibles;

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
            echo '<option value="' . $book['id'] . '">' . $book['codigo'] . ' | ' . $book['titulo'] . ' | ' . $book['cantidad'] . '</option>';
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
        $book = new M_book();
        extract($request->getPost());
        $booksElement = $entrega->getIdBook($id_entrega);
        $libro = $entrega->getLibro($id_entrega);
        $entrega->del_entrega($id_entrega);

        if ($libro['date_devol'] == NULL) {
            $book->contar($booksElement['fk_libro']);
        }
    }

    public function devolution()
    {
        /* $datos = $_POST['bookss'];
       print_r($datos); */
        $entrega = new M_entrega();
        $libros = new M_book();

        $request = \Config\Services::request();
        extract($request->getPost());
        $n = 1;
        $date_devol = strtotime($date_dev);

        foreach ($bookss as $nArr => $dI) {
            $idLibro = $entrega->getIdBook(intval($dI));
            if ($idLibro["date_entrega"] <= $date_devol) {
                if ($perdido == "false") {
                    $entrega->actualizar(intval($dI), $date_devol);
                    $libros->contar($idLibro["fk_libro"]);
                } else
                    $entrega->updateEstado(intval($dI), $date_devol);
            } else {
                echo "<li>" . $n++ . ".- Error en la selecci&oacute;n de la fecha: " . $date_dev . " del libro: " . $idLibro['titulo'] . "</li>";
            }
        }
        //echo "Registro actualizado!" . $perdido;
    }

    public function disponibility()
    {
        $request = \Config\Services::request();

        extract($request->getPost());

        $dispo = new M_disponibles();
        $book = new M_book();
        $cantidadE = $book->cantIdBook($fk_libro);
        $comprobation = $dispo->comprobation($fk_libro);


        if ($cantidadE['cantidad'] >= $c_disponibles) {
            $book->restarForDispo($fk_libro, $c_disponibles);
            if ($comprobation->getNumRows() > 0) {
                /* Obtengo el id, para actualizar */
                $dispo->actualizarCant($comprobation->getRowArray()['id'], $c_disponibles);
            } else {
                $dispo->saveDatos($fk_libro, $c_disponibles);
            }
        } else
            echo "Error en la cantidad!";
    }

    public function tb_dispo()
    {
        $request = \Config\Services::request();

        extract($request->getPost());
        $dispo = new M_disponibles();
        $json = array();
        $books = $dispo->librosDispo();

        foreach ($books as $data) {
            $json[] = $data;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
}
