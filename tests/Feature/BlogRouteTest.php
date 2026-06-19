<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogRouteTest extends TestCase
{
    use RefreshDatabase;

    public function test_blog_index_returns_successful_response()
    {
        $response = $this->get('/blog');
        $response->assertStatus(200);
    }

    public function test_blog_show_returns_successful_response()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $cat = ArticleCategory::create(['name' => 'Cerita', 'slug' => 'cerita']);
        $article = Article::create([
            'article_category_id' => $cat->id,
            'author_id' => $admin->id,
            'title' => 'Kerajinan Perak',
            'slug' => 'kerajinan-perak',
            'excerpt' => 'Test',
            'content' => 'Test',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $response = $this->get('/blog/kerajinan-perak');
        $response->assertStatus(200);
        $response->assertSee('Kerajinan Perak');
    }
}
