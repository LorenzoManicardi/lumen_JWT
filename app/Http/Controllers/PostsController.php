<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostsController extends Controller
{
    public function index()
    {
        return auth()->user()->posts;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "title" => "string|required",
            "body" => "string|required",
        ]);
        $p = new Post();
        $p->user_id = auth()->user()->id;
        $p->title = $request->title;
        $p->body = $request->body;
        $p->save();
        return $p;
    }

    public function show(Post $post, $id)
    {
        return $post->findOrFail($id);
    }

    public function update(Request $request, Post $post, $id)
    {
        $this->validate($request, [
            "title" => "string",
            "body" => "string",
        ]);
        $p = $post->findOrFail($id);
        if ($request->title) {
            $p->title = $request->title;
        }
        if ($request->body) {
            $p->body = $request->body;
        }
        $p->save();
        return $p;
    }

    public function destroy(Post $post, $id)
    {
        if (auth()->user()->posts->contains('id', $id)) {
            $p = $post->find($id);
            $p->delete();
        } else {
            return ['status' => 'error', 'message' => 'Wrong index!'];
        }
        return ['status' => 'success', 'message' => 'Post deleted successfully!'];
    }
}
