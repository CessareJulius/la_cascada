<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'nombre',
    ];

    public function menus(){
        return $this->hasMany(Menu::class);
    }
}
