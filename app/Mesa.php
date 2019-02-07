<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    protected $fillable = ['nro', 'status'];

    public function clientes(){
        return  $this->belongsToMany(Cliente::class);
    }

    public function pedidos(){
        return $this->hasMany(Pedido::class);
    }
}
