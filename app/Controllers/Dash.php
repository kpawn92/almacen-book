<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_municipios;
use App\Models\M_carrera;
use App\Models\M_yearA;
use App\Models\M_brigada;
use App\Models\M_student;
use App\Models\M_book;
use App\Models\M_entrega;
use App\Models\M_orders;
use App\Models\M_users;

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
            'ci' => 'required|is_natural|min_length[11]|max_length[11]|numeric'
        ]);

        if (!$validation) {
            $confirm  = $this->validator;
            return $confirm->listErrors();
        } else {
            extract($request->getPost());
            $student = new M_student();
            $users = new M_users();
            $rows_report = $student->row_preport($ci);
            if ($rows_report->getNumRows() > 0) {
                echo "2";
            } else {
                if ($nation != 1) {
                    $dir = "Cuba-cu-" . $direccion;
                    $student->guardar($ci, $nombre, $lastname, $nation, $dir, $fk_carrera, $fk_year_academico, $fk_brigada);
                    $users->createUser($ci);
                    echo "1";
                } else {
                    $dir = $pais . "-" . $ciudad;
                    $student->guardar($ci, $nombre, $lastname, $nation, $dir, $fk_carrera, $fk_year_academico, $fk_brigada);
                    $users->createUser($ci);
                    echo "1";
                }
            }
        }
    }

    public function edit_student()
    {
        $request = \Config\Services::request();
        $validation = $this->validate([
            'nombre' => 'required|min_length[1]|max_length[50]|alpha_space',
            'lastname' => 'required|min_length[1]|max_length[50]|alpha_space',
        ]);

        if (!$validation) {
            $confirm  = $this->validator;
            return $confirm->listErrors();
        } else {
            extract($request->getPost());
            $student = new M_student();
            $act = $student->update_student($id, $nombre, $lastname, $fk_carrera, $fk_year_academico, $fk_brigada);
            if ($act == false) {
                echo "Error de actualizaci&oacute;n";
            } else echo "<strong>Datos actualizados correctamente...</strong>";
        }
    }

    public function del_student()
    {
        $request = \Config\Services::request();
        $student = new M_student();
        $auth = new M_users();
        extract($request->getPost());
        $ci = $student->getCI($id);
        $query1 = $student->del_student($id);
        if ($query1 != true) {
            echo "false";
        } else {
            $auth->del_user($ci['ci']);
            echo "true";
        }
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
                if ($img = $request->getFile('portada')) {
                    $newName = $img->getRandomName();
                    $img->move('../public/uploads/', $newName);
                    $book->guardar($codigo, $titulo, $precio, $autor, $isbn, $cantidad, $newName);
                    echo 1;
                } else {
                    $newName = "no_portada.png";
                    $book->guardar($codigo, $titulo, $precio, $autor, $isbn, $cantidad, $newName);
                    echo 1;
                }
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
        //$datosLibro = $book->libroID($id_libro);
        //$ruta = ('../public/uploads/'.$datosLibro['portada']);
        //unlink($ruta);
        $query1 = $book->del_book($id_libro);
        if ($query1 != true) {
            echo "false";
        } else echo "true";
    }

    public function ci()
    {
        $estudiante = new M_student();
        $student = $estudiante->orderBy('id', 'DESC')->findAll();
        foreach ($student as $std) :
            echo '<option>' . $std['ci'] . '</option>';
        endforeach;
    }

    public function toast()
    {
        $orden = new M_orders();
        $ordenes = $orden->getOrdenNotif();

        $json = array();

        foreach ($ordenes as $data) {
            $json[] = $data;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }


    public function indicadores()
    {
        $book = new M_book();
        $student = new M_student();
        $perdida = new M_entrega();
        $venta = new M_orders();
        $books = $book->libros();
        $perdidos = $perdida->libros__perdidos();
        $std = $student->estudiantes();
        $sale = $venta->ventas();
        $total = 0;

        for ($i = 0; $i < count($sale); $i++) {
            $total += floatval($sale[$i]['pay']);
        }

        echo $books['idl'] . "-" . $perdidos['perdido'] . "-" . $std['std'] . "-" . $total;
    }

    public function topStudentsMayorSales()
    {
        $order = new M_orders();
        $json = array();
        $students = $order->getOrderStudents();

        $libros = $order->getBooksOrders();
        $arrayBooks = array();


        foreach ($libros as $key => $value) {
            $orderWithBooks = explode(",", $value['libros']);
            for ($i = 0; $i < count($orderWithBooks); $i++) {
                $arrayBooks[] = $orderWithBooks[$i];
            }
        }

        $uniqueBooks = array_unique($arrayBooks);


        sort($uniqueBooks);

        //Libros vendidos
        $json['books'][] = $arrayBooks;
        $json['books']['unique'] = $uniqueBooks;

        foreach ($students as $key => $data) {
            $json['data'][] = $data;
            $payTotal = $order->totalPayOrStudent(intval($data['fk_estudiante']));

            $json['data'][$key][] = $payTotal;
        }


        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
}
