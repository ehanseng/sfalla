<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Asegurarse de que solo se puedan ver los posts publicados
        if ($post->status !== 'published') {
            abort(404);
        }

        $metaTitle = $post->meta_title ?? $post->title;
        $metaDescription = $post->meta_description ?? Str::limit(strip_tags($post->content), 160);

        return view('post-show', compact('post', 'metaTitle', 'metaDescription'));
    }
}
