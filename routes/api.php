<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;




//Créé un lien qui permet aux clients : React, Vue, Angular,...


//Récupérer la liste des postes
Route::get('posts',[PostController::class, 'index']);



//Authentification

//Inscription d'un nouvel utilisateur
Route::post('/newUser',[UserController::class, 'newUser']);

//Connexion d'un nouvel utilisateur
Route::post('/login',[UserController::class, 'login']);



//les route sécurisé par mon middleware
Route::middleware('auth:sanctum')->group(function(){


    //Ajouter des posts avec la methode |POST
    Route::post('posts/creer',[PostController::class, 'creer']);


    //Modification des posts avec la methode PUT
    Route::put('posts/modifier/{post}',[PostController::class, 'modifier']);


    //suppression des posts avec la methode PUT
    Route::delete('posts/{post}',[PostController::class, 'supprimer']);




    //Permet de retourner l'utilisateur connecté
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});

