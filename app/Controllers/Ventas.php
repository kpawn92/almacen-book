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
}
