<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;




//Créé un lien qui permet aux clients : React, Vue, Angular,...


//Récupérer la liste des postes
Route::get('posts',[PostController::class, 'index']);


//Ajouter des posts avec la methode |POST
Route::post('posts/creer',[PostController::class, 'creer']);


//Modification des posts avec la methode PUT
Route::put('posts/modifier/{post}',[PostController::class, 'modifier']);


//suppression des posts avec la methode PUT
Route::delete('posts/{post}',[PostController::class, 'supprimer']);









Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
