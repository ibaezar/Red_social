<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller{

    //Requerir autenticación
    public function __conntruct(){
        $this->middleware('auth');
    }

    public function save(Request $request){
        //Validacion
        $validate = $this->validate($request, [
            'image_id' => 'required',
            'content'  => 'required|'
        ]);
        
        //Recogemos los datos
        $image_id = (int)$request->input('image_id');
        $content = $request->input('content');

        //Asignar valores al objeto
        $user = \Auth::user();
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        $comment->save();

        return redirect()->route('image.detail', ['id' => $image_id]);
    }

    public function delete($id){

        //Datos usuario logeado
        $user = \Auth::user();

        //Conseguir datos del objeto comment
        $comment = Comment::find($id);

        //Comprobar si soy dueño del comentario o de la publicacion.
        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
            //eliminar comentario
            $comment->delete();

            return redirect()->route('image.detail', ['id' => $comment->image->id]);
        }
    }
}
