<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $fillable = ['codigo', 'cliente_id', 'fecha', 'subtotal', 'total'];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function pedidos(){
        return  $this->belongsToMany(Pedido::class);
    }
}
