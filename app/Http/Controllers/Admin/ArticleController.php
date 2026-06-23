<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Store;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function __construct(
        protected CloudinaryService $cloudinary
    ) {}
    public function index()
    {
        $articles = Article::with('category', 'author')->latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = ArticleCategory::all();
        $stores = Store::active()->get();
        return view('admin.articles.create', compact('categories', 'stores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'article_category_id' => 'nullable|exists:article_categories,id',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|mimetypes:image/jpeg,image/png,image/webp|max:2048',
            'stores' => 'nullable|array',
            'stores.*' => 'exists:stores,id'
        ]);

        $data = $request->except(['featured_image', 'stores']);
        // Sanitize content to prevent XSS
        $data['content'] = strip_tags($request->content, '<p><br><b><strong><i><em><ul><ol><li><a><h1><h2><h3><h4><h5><h6><img><blockquote><hr>');
        $data['slug'] = Str::slug($request->title) . '-' . uniqid();
        $data['author_id'] = auth()->id();
        
        if ($request->status === 'published') {
            $data['published_at'] = now();
        }

        if ($request->hasFile('featured_image')) {
            $result = $this->cloudinary->uploadArticleImage($request->file('featured_image'));
            $data['featured_image_url'] = $result['url'];
        }

        $article = Article::create($data);

        if ($request->has('stores')) {
            $article->stores()->sync($request->stores);
        }

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diterbitkan.');
    }

    public function edit(Article $article)
    {
        $categories = ArticleCategory::all();
        $stores = Store::active()->get();
        return view('admin.articles.edit', compact('article', 'categories', 'stores'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'article_category_id' => 'nullable|exists:article_categories,id',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|mimetypes:image/jpeg,image/png,image/webp|max:2048',
            'stores' => 'nullable|array',
            'stores.*' => 'exists:stores,id'
        ]);

        $data = $request->except(['featured_image', 'stores']);
        // Sanitize content to prevent XSS
        $data['content'] = strip_tags($request->content, '<p><br><b><strong><i><em><ul><ol><li><a><h1><h2><h3><h4><h5><h6><img><blockquote><hr>');
        
        if ($article->status === 'draft' && $request->status === 'published') {
            $data['published_at'] = now();
        }

        if ($request->hasFile('featured_image')) {
            $this->cloudinary->deleteImage($article->featured_image_url);
            $result = $this->cloudinary->uploadArticleImage($request->file('featured_image'));
            $data['featured_image_url'] = $result['url'];
        }

        $article->update($data);

        if ($request->has('stores')) {
            $article->stores()->sync($request->stores);
        } else {
            $article->stores()->detach();
        }

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        $this->cloudinary->deleteImage($article->featured_image_url);
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
