<?php

namespace App\Http\Controllers;

use App\Mesa;
use App\Cliente;
use App\Factura;
use App\Configuracion;
use Illuminate\Http\Request;

class FacturasController extends Controller
{
    public function index(){
        $mesas = Mesa::where('status', 'ocupada')->get();
        $facturas = Factura::orderBy('id', 'desc')->get();
        return view('facturas.index', compact('facturas', 'mesas'));
    }

    public function verify_client($dni, $mesa){
        $mesa_obj = null;
        $pedidos  = null;
        $cliente_obj = Mesa::findOrFail($mesa)->clientes()->where('dni', $dni)->first();
        $cliente = Cliente::where('dni', $dni)->first();

        if($cliente != null){
            $mesa_obj = $cliente->mesas()->find($mesa);
            if($mesa_obj != null){
                $pedidos = $mesa_obj->pedidos()
                                    ->where('status', '!=', 'cancelado')
                                    ->where('status', '!=', 'pagado')
                                    ->where('cliente_id', $cliente->id)
                                    ->get();
            }
            //dd($mesa_obj);
        }
        
        return response()->json([
            'mesa'      => $mesa_obj,
            'cliente'   => $cliente_obj,
            'pedidos'   => $pedidos,
        ], 200);
    }

    public function crear(Request $request){
        $dni = $request->dni;
        $mesa = $request->mesa;
        $factura_id = 1;

        $data = $this->verify_client($dni, $mesa)->original;
        $mesa_obj   = $data['mesa'];
        $cliente    = $data['cliente'];
        $pedidos    = $data['pedidos'];
        $iva        = Configuracion::first();

        $invoice_code = '';
        $factura = Factura::orderBy('id', 'desc')->first();
        if($factura != null){
            $factura_id = $factura->id;
        }
        
        //dd(2);
        return view('facturas.create', compact('mesa_obj', 'cliente', 'pedidos', 'iva', 'dni', 'mesa','factura_id', 'invoice_code'));
    }
}
