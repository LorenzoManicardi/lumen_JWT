<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            $post->user = $post->user;
            $post->comments = $post->comments;
        }
        return $posts;
    }

    public function show($id)
    {
        $post = Post::all()->where('id', $id)->first();
        $post->user = $post->user;
        $post->comments = $post->comments;
        return $post;
    }
}
