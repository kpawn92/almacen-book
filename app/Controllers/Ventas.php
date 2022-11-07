<?php

namespace App\Controllers;

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
        $fecha_solicited = $order->getDateOrder($id)['date_order'];
        $fecha_aprobado = $order->getDateOk($id)['date_okay'];
        
        if ($fecha_solicited < $fecha && $fecha_aprobado === null) {
            $order->update_order($id, $fecha);
            return "3";
        }
        return "0";
    }

    public function cancel_order()
    {
        $order = new M_orders();
        $request = \Config\Services::request();
        extract($request->getPost());

        $order->upd_order_status($id);
        return "0";        
    }

    public function set_pay()
    {
        $order = new M_orders();
        $request = \Config\Services::request();
        extract($request->getPost());

        $order->upd_payeer($id);
        return "0";        
    }
}
