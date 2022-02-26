<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        return auth()->user()->comments;
    }
    
    public function show($id)
    {
        return auth()->user()->comments->where('id', $id);
    }
    
    public function store(Request $request, $post_id)
    {
        $this->validate($request, [
            'comment_body' => 'string'
        ]);
        $c = Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post_id,
            'comment_body' => $request->comment_body,
        ]);
        return $c;
    }
    
    public function update(Request $request, $post_id, $id)
    {
        $this->validate($request, [
            'post_id' => 'integer',
            'comment_body' => 'string'
        ]);
        $c = Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post_id,
            'comment_body' => $request->comment_body,
        ]);
        return $c;
    }
    
    public function destroy($id)
    {

    }
}
