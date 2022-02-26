<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        return auth()->user()->posts;
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Post $post, $id)
    {
        return $post->findOrFail($id);
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }
}
