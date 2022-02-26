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
    
    public function store($post_id)
    {
        PostLikes::updateOrCreate([
            'post_id' => $post_id,
            'user_id' => auth()->user()->id
        ]);
        return ["status" => "success", "message" => "post liked successfully!"];
        
    }
    
    public function destroy($post_id)
    {
        $p = PostLikes::all()->where('user_id', auth()->user()->id)->where('post_id', $post_id);
        if ($p->first()) {
            $p->first()->delete();
            return ["status" => "success", "message" => "post unliked successfully!"];
        } else {
            return ["status" => "error", "message" => "like not found!"];
        }
    }
}
