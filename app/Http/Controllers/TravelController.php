<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    public function index()
    {
        $category = Category::where('slug', 'viajes')->firstOrFail();
        $posts = Post::where('category_id', $category->id)
                     ->where('status', 'published')
                     ->latest()
                     ->get();

        return view('viajes', compact('posts', 'category'));
    }
}
