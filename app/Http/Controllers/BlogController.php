<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::with('category', 'author')
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->paginate(12);

        return view('blog.index', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::with(['category', 'author', 'stores'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Rekomendasi artikel lain
        $relatedArticles = Article::where('status', 'published')
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blog.show', compact('article', 'relatedArticles'));
    }
}
