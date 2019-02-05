<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'codigo', 'nombre', 'descripcion', 
        'precio', 'tiempo_preparacion', 'status', 
        'cantidad', 'categoria_id',
    ];

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function pedidos(){
        return $this->hasMany(Pedido::class);
    }
}
