<?php

namespace App\Http\Controllers;

use App\Pedido;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function index(){
        $fecha = date('Y-m-d');
        $fecha1 = $fecha.' 00:00:00';
        $fecha2 = $fecha.' 23:59:59';
        $pedidos = Pedido::whereBetween('created_at', [$fecha1, $fecha2])->orderBy('id', 'asc')->get();
        //dd($pedidos);
        return view('pedidos.index', compact('pedidos'));
    }
}
