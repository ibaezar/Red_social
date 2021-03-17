<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Rutas principales
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect()->route('home');
})->name('dashboard');
Route::get('/', [HomeController::class, 'index'])->name('home');

//Rutas imagenes
Route::get('/imagen/subir', [ImageController::class, 'create'])->name('image.create');
Route::get('/image/file/{filename}', [ImageController::class, 'getImage'])->name('image.file');
Route::get('/imagen/eliminar/{id}', [ImageController::class, 'delete'])->name('image.delete');
Route::post('/imagen/guardar', [ImageController::class, 'save'])->name('image.save');

//Rutas comentarios
Route::post('/comentario/guardar', [CommentController::class, 'save'])->name('comment.save');
Route::get('/comentario/eliminar/{id}', [CommentController::class, 'delete'])->name('comment.delete');

//Rutas likes
Route::get('/like/{image_id}', [LikeController::class, 'like'])->name('like');
Route::get('/dislike/{image_id}', [LikeController::class, 'dislike'])->name('dislike');

//Rutas usuarios
Route::get('/perfil/{id}', [UserController::class, 'profile'])->name('profile');

//Rutas publicaciones
Route::get('/post/{id}', [ImageController::class, 'detail'])->name('image.detail');

//Rutas Buscadores
Route::get('/buscar/{consulta}', [UserController::class, 'search'])->name('search');