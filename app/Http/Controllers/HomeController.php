<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Image;
use App\Models\Like;

class HomeController extends Controller
{
    public function index(){
        $images = Image::orderBy('id', 'desc')->paginate(10);

        return view('home', [
            'images' => $images
        ]);
    }
}
