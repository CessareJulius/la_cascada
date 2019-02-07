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
        $conf        = Configuracion::first();

        $invoice_code = 'F'.random_int(100, 1000).strtoupper(str_random('1').random_int(100, 1000));
        $factura = Factura::orderBy('id', 'desc')->first();
        if($factura != null){
            $factura_id = $factura->id;
        }
        
        //dd($invoice_code);
        return view('facturas.create', compact('mesa_obj', 'cliente', 'pedidos', 'conf', 'dni', 'mesa','factura_id', 'invoice_code'));
    }

    public function store(Request $request){
        $data = $this->verify_client($request->dni, $request->mesa)->original;
        $mesa_obj   = $data['mesa'];
        $cliente    = $data['cliente'];
        $pedidos    = $data['pedidos'];

        $factura = Factura::create([
            'codigo'        => $request->codigo,
            'cliente_id'    => $cliente->id,
            'fecha'         => date('Y-m-d h:m'),
            'subtotal'      => $request->subtotal,
            'total'         => $request->total 
        ]);

        $factura->pedidos()->attach($pedidos);

        foreach ($pedidos as $pedido) {
            $pedido->status = 'pagado';
            $pedido->update;
        }

        $cliente->mesas()->detach($mesa_obj);

        $mesa_obj->status = 'disponible';
        $mesa_obj->update();

        //dd($factura);

        return redirect()->route('facturas.index')->with('success', 'Factura y pago creados con exito!.');
    }
}
