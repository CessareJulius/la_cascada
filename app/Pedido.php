<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['nro_orden', 'mesa_id', 'cliente_id', 'menu_id', 'cantidad', 'status'];

    public function mesa(){
        return $this->belongsTo(Mesa::class);
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function facturas(){
        return  $this->belongsToMany(Factura::class);
    }
}
