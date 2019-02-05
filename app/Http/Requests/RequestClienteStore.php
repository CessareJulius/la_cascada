<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestClienteStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'     => 'required|email',
            'password'  => 'required|min:6',
            'dni'       => 'required|min:5|unique:clientes,dni',
            'nombre'    => 'required',
            'apellido'  => 'required',
            'mesa'      => 'int',
        ];
    }

    public function messages(){
        return [
            'email.required'    => 'Error, Este campo es requerido',
            'email.email'       => 'Error, El tipo de dato no es de tipo email',
            'password.required' => 'Error. Este campo es requerido',
            'password.min'      => 'Error. La contraseña debe ser de minimo 6 dígitos',
            'dni.required'      => 'Error. Este campo es requerido',
            'dni.min'           => 'Error. Longitud invalida',
            'dni.unique'        => 'Error. Esta cédula ya existe',
            'nombre.required'   => 'Error. Este campo es requerido',
            'apellido.required' => 'Error. Este campo es requerido',
            'mesa.integer'          => 'Error. Debe selleccionar una mesa',
        ];
    }
}
