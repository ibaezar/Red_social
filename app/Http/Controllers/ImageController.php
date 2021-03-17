<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Like;
//Agregar ubicacion para ficheros
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImageController extends Controller{
       
    //Requerir autenticación
    public function __conntruct(){
        $this->middleware('auth');
    }

    public function create(){
        return view('image.create');
    }

    public function detail($id){
        $image = Image::find($id);

        return view('image.detail', [
            'image' => $image
        ]);
    }

    public function save(Request $request){
        //Validacion
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path'  => 'required|image'
        ]);
        
        //Recogemos los datos
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        //Asignar valores al objeto
        $user = \Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $description;

        //Subir imagen
        if($image_path){
            $image_path_name = time().'-'.$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->save();

        return redirect()->route('image.create')->with([
            'message' => 'La foto ha sido subida correctamente'
        ]);
    }

    //Funcion para mostrar imagen
    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    //Eliminar imagen
    public function delete($id){
        $user = \Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();

        if($user && $image->user_id == $user->id){

            //Eliminar los comentarios asociados
            if($comments && count($comments) >= 1){
                foreach($comments as $comment){
                    $comment->delete();
                }
            }

            //Eliminar los comentarios asociados
            if($likes && count($likes) >= 1){
                foreach($likes as $like){
                    $like->delete();
                }
            }

            //Eliminar ficheros de la imagen
            Storage::disk('images')->delete($image->image_path);

            //Eliminar imagen de la base de datos
            $image->delete();

            $message = array('message' => 'La imagen ha sido eliminada correctamente');
        }else{
            $message = array('message' => 'No se ha podido eliminar la imagen');
        }

        return redirect()->route('home')->with($message);
    }

}
