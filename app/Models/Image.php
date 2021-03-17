<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    //Indicar tabla con la que va a interactuar.
    protected $table = 'images';

    //Crear relacion One to Many / Uno a muchos.
    public function comments(){
        return $this->hasMany('App\Models\Comment')->orderBy('id', 'desc');
    }

    //Crear relacion One to Many / Uno a muchos.
    public function likes(){
        return $this->hasMany('App\Models\Like');
    }

    //Crear relacion Many to One / Muchos a uno.
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
