<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreerPostRequest;
use App\Http\Requests\ModifierPostRequest;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;


class PostController extends Controller
{
    //
    public function index(Request $request)
    {

        try{
            //Pour la pargination

            $query = Post::query();
            $parpage = 5;
            $page = $request->input('page', 1);
            $search = $request->input('search');

            if($search)
            {
                $query->whereRaw("titre LIKE '%". $search ."%'");
            }
            $total = $query->count();

            //la pargination avec offset
            $resultat = $query->offset(($page-1) * $parpage)->limit($parpage)->get();

            return response()->json([
                'status_code'=> 200,
                'status_message' => 'Tous les postes ont été récupérer',
                'page_actuelle' => $page,
                'nomber_of_page'=> ceil($total / $parpage),
                'items'=> $resultat
            ]);

        }catch (Exception $e){
            return response()->json($e);
        }
    }

    public function creer(CreerPostRequest $request)
    {
        try {

            $posts = new Post();

            $posts->titre = $request->titre;
            $posts->description = $request->description;

            $posts->save();

            return response()->json([
                'status_code' => 200,
                'status_message'=> 'Le poste a été ajouté',
                'data' => $posts
            ]);

        } catch (Exception $e)
        {
            return response()->json($e);
        }
    }

    public function modifier(ModifierPostRequest $request, Post $post)
    {
        try
        {

            $post->titre = $request->titre;
            $post->description = $request->description;

            $post->save();

            return response()->json([
                'status_code'=> 200,
                'status_message'=>'Le post a bien été modifier',
                'date' => $post
            ]);

        }catch (Exception $e)
        {
            return response()->json($e);
        }
    }

    public function supprimer(Post $post)
    {
        try{

            $post->delete();

            return response()->json([
                'status_code'=> 200,
                'status_message'=>'Le post a bien été supprimer',
                'date' => $post
            ]);

        }catch (Exception $e){

            return response()->json($e);

        }
    }

}
