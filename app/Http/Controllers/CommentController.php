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
    
    public function store(Request $request)
    {

    }
    
    public function update(Request $request, $id)
    {

    }
    
    public function destroy($id)
    {

    }
}
