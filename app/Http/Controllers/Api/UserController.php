<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function newUser (UserRequest $request)
    {
//        dd('ok');
        try {

            $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            $user->save();

            return response()->json([
                'status_code' => 200,
                'status_message'=> "Inscription réussie",
                'data' => $user
            ]);

        } catch (Exception $e)
        {
            return response()->json($e);
        }
    }

    public function login (LoginUserRequest $request)
    {
        $data = $request->only(['email', 'password']);
        if(Auth::attempt($data))
        {
            $user = auth()->user();
            $token = $user->createToken('MA_CLE_SECRETE_VISIBLE_EN_BACKEND_SEULEMENT')
                ->plainTextToken;            //Une clé permettant de récupéré les informations cachés


            return response()->json([
                'status_code' => 200,
                'status_message'=> "Utilisateur connecté avec succès",
                'Utilisateur' => $user,
                'token' => $token,
            ]);

        }else{

            return response()->json([
                'status_code' => 401,
                'status_message'=> "Information incorrecte",
            ]);

        };
    }
}
