<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['user_id', 'dni', 'nombre', 'apellido', 'telefono', 'direccion'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function mesas(){
        return  $this->belongsToMany(Mesa::class);
    }
}
