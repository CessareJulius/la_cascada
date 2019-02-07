<?php

namespace App\Http\Controllers;

use Auth;
use App\Menu;
use App\Pedido;
use App\Categoria;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    public function index(){
        //$menus = Menu::where('status', 'disponible')->get();
        $categorias = Categoria::all();
        return view('menus.index', compact('categorias'));
    }

    public function charge_menu($categoria){
        $menu = Menu::where('status', 'disponible')->where('categoria_id', $categoria)->get();
        $menu->load('categoria');
        return response()->json([
            'menu' => $menu
        ], 200);
    }

    public function categoria_store(Request $request){
        
        $this->validate($request, [
            'nombre' => 'required|unique:categorias,nombre',
        ], [
            'nombre.unique' => 'Error. Este nombre ya existe',
        ]);
        $cat = categoria::where('nombre', strtolower($request->nombre))->first();
        if($cat != null){
            return back()->with('error', 'La categoria ingresada ya se encuentra registrada!.');
        }
        //dd($request->all());
        $categoria = Categoria::create($request->all());
        return redirect()->route('menus.index')->with('success', 'Categoria: '.$request->nombre.' registrada con exito!.');
    }

    public function store(Request $request){
        $this->validate($request, [
            'codigo' => 'required|unique:menus,codigo',
        ], [
            'codigo.unique' => 'Error. Este codigo ya existe',
        ]);
        $menu = Menu::create([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion, 
            'precio' => $request->precio,
            'tiempo_preparacion' => $request->tiempo_preparacion.':00',
            'status' => $request->status, 
            'cantidad' => $request->cantidad,
            'categoria_id' => $request->categoria,
        ]);
        return redirect()->route('menus.index')->with('success', 'Item: '.$request->nombre.' registrado con exito!.');
    }

    public function save_pedido(Request $request){
        if(count(Auth::user()->cliente->mesas) == 0){
            return response()->json([
                'message' => 'Usted no tiene una mesa asignada',
            ], 500);
        } else {
            if(Auth::user()->cliente != null){
                $pedido = Pedido::create([
                    'nro_orden'     => random_int(1000, 100000), 
                    'mesa_id'       => Auth::user()->cliente->mesas[0]->id,
                    'cliente_id'    => Auth::user()->cliente->id,
                    'menu_id'       => $request->item['id'],
                    'cantidad'      => $request->cantidad,
                    'status'        => 'en_espera',
                ]);
            }
    
            return response()->json([
                'message' => 'success'
            ], 200);
        }
    }
}
