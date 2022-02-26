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
    
    public function show($post_id)
    {
        return auth()->user()->comments->where('post_id', $post_id);
    }
    
    public function store(Request $request, $post_id)
    {
        $this->validate($request, [
            'comment_body' => 'string|required'
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
            'comment_body' => 'string|required'
        ]);

        $c = auth()->user()->comments->where('post_id', $post_id)->find($id);
        $c->update([
            'comment_body' => $request->comment_body
        ]);
        return $c;
    }
    
    public function destroy($post_id, $id)
    {
        $c = auth()->user()->comments->where('post_id', $post_id)->find($id);
        $c->delete();
        return ["status" => "success", "message" => "Comment deleted successfully!"];
    }
}
