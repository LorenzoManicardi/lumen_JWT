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

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);
        $n = new Post([
            "user_id" => auth()->user()->id,
            "title" => $request->title,
            "content" => $request->content
        ]);
        $n->save();
        return $n;
    }

    public function update(Request $request, $id)
    {
        $post = Post::all()->where('id', $id)->first();
        $post->user = $post->user;
        $post->comments = $post->comments;
        return $post;
    }

    public function destroy($id)
    {
        $post = Post::all()->where('id', $id)->first();
        $post->user = $post->user;
        $post->comments = $post->comments;
        return $post;
    }
}
