<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_book;
use App\Models\M_comment;
use App\Models\M_disponibles;
use App\Models\M_entrega;
use App\Models\M_orders;

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
        if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            $db = \Config\Database::connect();
            $query = $db->query("UPDATE tb_users SET logged = 1 WHERE id = '$id'");
        }
        return view('User/usuario');
    }

    public function cerrar()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT*FROM tb_users WHERE logged = 1");
        $id = $query->getRowArray()['id'];
        $db->query("UPDATE tb_users SET logged = 0 WHERE id = '$id'");
    }

    public function getUserName()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT*FROM tb_users WHERE logged = 1");
        $json = array();
        $id = $query->getRowArray()['id'];
        $fila = $db->query("SELECT nombre, lastname, tb_estudiante.id as id__std FROM tb_users JOIN tb_estudiante ON tb_estudiante.ci = tb_users.password WHERE logged = 1 AND tb_users.id = '$id'");
        foreach ($fila->getRowArray() as $data) {
            $json[] = $data;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }

    public function libros__disponibles()
    {
        if ($_POST['accion'] == "listarLibro") {
            $book = new M_disponibles();
            $json = array();
            $books = $book->list_book();

            foreach ($books as $data) {
                $json['data'][] = $data;
            }
            $jsonstring = json_encode($json);
            echo $jsonstring;
        }
    }

    public function orders()
    {

        $orden = new M_orders();
        $orden = new M_orders();
        $book = new M_disponibles();
        $request = \Config\Services::request();
        extract($request->getPost());

        $array = explode(",", $libros[0]);

        $rows_report = $orden->row_preport($fk_estudiante);

        if ($rows_report->getNumRows() >= 2) {
            echo "3";
        } else {
            $sendOrden = $orden->guardar($fk_estudiante, $libros, $pay, $date = time());
            for ($i = 0; $i < count($array); $i++) {
                $book->descontar(intval($array[$i]));
            }
            $resultado = $sendOrden ? "1" : "2";
            echo $resultado;
        }
    }
    public function libXid()
    {
        $id = $_POST['item'];
        $libros_dados = new M_entrega();
        $json = array();
        $query = $libros_dados->list_book_id($id);
        foreach ($query as $data) {
            $json['data'][] = $data;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    public function p_order()
    {
        $order = new M_orders();
        $id = $_POST['id'];
        $json = array();
        $orden = $order->getOrdersID($id);

        foreach ($orden as $data) {
            $json[] = $data;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }

    public function librosSales()
    {
        $libro = new M_disponibles();
        $libros = $_POST['libros'];

        $json = array();

        $array = explode(',', $libros);

        for ($i = 0; $i < count($array); $i++) {
            $getTitulo = $libro->getLibroReceived(intval($array[$i]));
            $json[] = $getTitulo['titulo'];
        }

        $jsonstring = json_encode($json);
        echo $jsonstring;        
    }

    public function commentSave()
    {
        $request = \Config\Services::request();
        extract($request->getPost());
        $comments = new M_comment();

        $query = $comments->guardar(intval($id), $subject, $comment);

        if(!$query) return "0";

        return "1";

    }
}
