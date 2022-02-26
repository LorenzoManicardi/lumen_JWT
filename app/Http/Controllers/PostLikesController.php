<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostLikes;
use App\Models\Post;

class PostLikesController extends Controller
{
    public function index()
    {
        $likes = auth()->user()->postLikes;
        return ["status" => "success", "totalLikes" => count($likes)];
    }
    
    public function show($post_id)
    {
        $p = Post::all()->find($post_id);
        $c = 0;
        $ids = array();
        foreach ($p->likes as $like) {
            $c++;
            $ids[] = ["id" => $like->user->id, "name" => $like->user->name];
        }
        $toReturn = [
            "post_likes" => $c,
            "users_liked" => $ids
        ];
        return $toReturn;
    }
    
    public function store()
    {}
    
    public function delete()
    {}
}
