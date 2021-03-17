<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    //Indicar tabla con la que va a interactuar.
    protected $table = 'comments';

    //Crear relacion Many to One / Muchos a uno.
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    //Crear relacion Many to One / Muchos a uno.
    public function image(){
        return $this->belongsTo('App\Models\Image', 'image_id');
    }
}
