<?php

namespace App\Controllers;

use App\Models\M_disponibles;
use App\Models\M_orders;
use CodeIgniter\Controller;

class Ventas extends Controller
{
    public function order()
    {
        $order = new M_orders();
        if ($_POST['pos'] == "listarOrden") {
            $json = array();
            $orden = $order->getOrders();

            foreach ($orden as $data) {
                $json['data'][] = $data;
            }
            $jsonstring = json_encode($json);
            echo $jsonstring;
        }
    }

    public function date_aprobado()
    {
        $order = new M_orders();
        $request = \Config\Services::request();
        extract($request->getPost());

        $fecha = strtotime($date);
        $condition = $order->getFechaOk($id)['condition'];
        $fecha_solicited = $order->getDateOrder($id)['date_order'];

        if ($fecha_solicited < $fecha) {
            if ($condition === "0" || $condition === "2") {
                $order->update_order($id, $fecha);
                return "3";
            }
        }
        return $condition;
    }

    public function cancel_order()
    {
        $order = new M_orders();
        $request = \Config\Services::request();
        extract($request->getPost());

        $condition = $order->getFechaOk($id)['condition'];
        if ($condition === "0") {
            $order->upd_order_status($id);
            return "1";
        }
        return "0";
    }

    public function set_pay()
    {
        $order = new M_orders();
        $request = \Config\Services::request();
        extract($request->getPost());

        $condition = $order->getFechaOk($id)['condition'];

        if ($condition === "3") {

            $order->upd_payeer($id);
            return "1";
        }
        return "0";
    }

    public function librosSales()
    {
        $libro = new M_disponibles();
        $libros = $_POST['libros'];

        $json = array();

        $array = explode(',', $libros);

        for ($i = 0; $i < count($array); $i++) {
            $getTitulo = $libro->getLibroReceivedRoot(intval($array[$i]));
            foreach ($getTitulo as $data) {
                $json[] = $data;
            }
        }

        $jsonstring = json_encode($json);
        echo $jsonstring;
    }

    public function cancelSales()
    {
        $order = new M_orders();
        $id = $_POST['id'];
        $condition = $order->getFechaOk($id)['condition'];
        if ($condition === "0") {
            $order->upd_order_status($id);
            return "1";
        }
        return "0";
    }

    public function paySales()
    {
        $order = new M_orders();
        $id = $_POST['id'];
        $condition = $order->getFechaOk($id)['condition'];
        if ($condition === "3") {
            $order->upd_payeer($id);
            return "1";
        }
        return "0";
    }

    public function editSalesAll()
    {
        $order = new M_orders();
        $id = $_POST['id'];
        $fecha = $_POST['fecha'];
        $fecha_order = $order->getDateOrder($id)['date_order'];
        $date = strtotime($fecha);
        $condition = $order->getFechaOk($id)['condition'];
        if ($fecha_order > $date) {
            return "0";
        } else {
            if ($condition === "0" || $condition === "2") {
                $order->update_order($id, $date);
                return "1";
            }
        }
        return "0";
    }
}
