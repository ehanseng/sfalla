<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VanLifeController extends Controller
{
    public function index()
    {
        $category = Category::where('slug', 'van-life')->firstOrFail();
        $posts = Post::where('category_id', $category->id)
                     ->where('status', 'published')
                     ->latest()
                     ->get();

        return view('van-life', compact('posts', 'category'));
    }

    public function show(Post $post)
    {
        // Asegurarse de que solo se puedan ver los posts publicados
        if ($post->status !== 'published') {
            abort(404);
        }

        $metaTitle = $post->meta_title ?? $post->title;
        $metaDescription = $post->meta_description ?? Str::limit(strip_tags($post->content), 160);

        return view('van-life-show', compact('post', 'metaTitle', 'metaDescription'));
    }
}
