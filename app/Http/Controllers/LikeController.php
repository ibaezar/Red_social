<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Like;

class LikeController extends Controller{
    
    //Requerir autenticación
    public function __conntruct(){
        $this->middleware('auth');
    }

    public function like($image_id){
        //datos del usuario logeado
        $user = \Auth::user();

        //Comprobar si ya se ha realizado un like
        $isset_like = Like::where('user_id', $user->id)
                        ->where('image_id', $image_id)
                        ->count();

        //Setear datos del objeto like
        if($isset_like == 0){
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;

            //Guardar like
            $like->save();

            // return response()->json([
            //     'like' => $like
            // ]);

            return redirect()->route('image.detail', ['id' => $image_id]);

        }else{
            // return response()->json([
            //     'message' => 'El like ya existe'
            // ]);
            return redirect()->route('image.detail', ['id' => $image_id]);
        }
    }

    public function dislike($image_id){
        //datos del usuario logeado
        $user = \Auth::user();

        //Comprobar si ya se ha realizado un like
        $like = Like::where('user_id', $user->id)
                        ->where('image_id', $image_id)
                        ->first();

        //Setear datos del objeto like
        if($like){

            //Eliminar like
            $like->delete();

            // return response()->json([
            //     'like' => $like,
            //     'message' => 'Has dado dislike'
            // ]);

            return redirect()->route('image.detail', ['id' => $image_id]);

        }else{
            // return response()->json([
            //     'message' => 'El like no existe'
            // ]);

            return redirect()->route('image.detail', ['id' => $image_id]);
        }
    }
}
