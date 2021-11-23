<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json([
            'success'=>true,
            'results'=>$posts
        ]);
    }
    public function show($slug)
    {
        $posts = Post::where('slug', $slug)->first();
        return response()->json([
            'success'=>true,
            'results'=>$posts
        ]);
    }
}




