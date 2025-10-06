<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = Post::where('category_id', $category->id)
                     ->where('status', 'published')
                     ->latest()
                     ->get();

        return view('category-show', compact('posts', 'category'));
    }
}
