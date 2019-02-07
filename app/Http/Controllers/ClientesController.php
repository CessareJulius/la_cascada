<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Mesa;
use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RequestClienteStore;

class ClientesController extends Controller
{
    public function index()
    {
        $mesas = Mesa::where('status', 'disponible')->get();
        $clientes = Cliente::all();
        //$clientes->load('user');
        //dd($clientes);
        return view('clientes.index', compact('clientes', 'mesas'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function dni_verify($dni){
        $cliente = Cliente::where('dni', $dni)->first();
        return response()->json(['cliente' => $cliente]);
    }

    public function store(RequestClienteStore $request)
    {
        //dd($request->all());
        $user = User::where('email', $request->email)->first();
        
        if($request->telefono != null){
            $this->validate($request, [
                'telefono'  => 'unique:clientes,telefono',
            ], [
                'telefono.unique'   => 'Error. Este telefono ya existe',
            ]);
        }

        $mesa = Mesa::findOrFail($request->mesa);
        if($mesa->clientes->count() > 0){
            return back()->with('error', 'La mesa seleccionada no se encuentra disponible');
        }

        if($user == null){
            $this->validate($request, [
                'email'  => 'unique:users,email',
            ], [
                'email.unique'      => 'Error. Este correo ya existe',
            ]);
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            if($user->cliente != null){
                return back()->with('error', 'El email ingresado ya pertenece a un cliente!.');
            }
        }
        
        $cliente = Cliente::create([
            'user_id'   => $user->id,
            'dni'       => $request->dni,
            'nombre'    => $request->nombre,
            'apellido'  => $request->apellido,
            'telefono'  => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        $cliente->mesas()->attach($mesa);

        $mesa->status = 'ocupada';
        $mesa->update();

        return redirect()->route('clientes.index')->with('success', 'Cliente Registrado con exito');
    }

    public function assoc_client_board(Request $request)
    {
        $this->validate($request, [
            'mesa'      => 'int',
        ], [
            'mesa.integer'          => 'Error. Debe selleccionar una mesa',
        ]);

        $cliente = Cliente::where('dni', $request->dni)->first();
        $mesa = Mesa::findOrFail($request->mesa);
        $cliente->mesas()->attach($mesa);
        $mesa->status = 'ocupada';
        $mesa->update();
        return redirect()->route('clientes.index')->with('success', 'Cliente agregado a la mesa #'.$mesa->nro);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
