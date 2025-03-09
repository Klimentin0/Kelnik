<?php
// tests/Feature/ArticlesApiTest.php

namespace Tests\Feature;

use App\Domain\Articles\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticlesApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_all_articles()
    {
        Article::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/articles');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'author',
                        'brief',
                        'full_text',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }

    /** @test */
    public function can_create_article()
    {
        $data = [
            'title' => 'Test Article',
            'author' => 'John Doe',
            'brief' => 'This is a brief summary',
            'full_text' => 'This is the full article content'
        ];

        $response = $this->postJson('/api/v1/articles', $data);

        $response->assertStatus(201)
            ->assertJsonFragment($data)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'author',
                    'brief',
                    'full_text',
                    'created_at',
                    'updated_at'
                ]
            ]);

        $this->assertDatabaseHas('articles', $data);
    }

    /** @test */
    public function can_get_single_article()
    {
        $article = Article::factory()->create();

        $response = $this->getJson("/api/v1/articles/{$article->id}");

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => [
                    'id' => $article->id,
                    'title' => $article->title,
                    'author' => $article->author,
                    'brief' => $article->brief,
                    'full_text' => $article->full_text,
                    'created_at' => $article->created_at->toISOString(),
                    'updated_at' => $article->updated_at->toISOString()
                ]
            ]);
    }

    /** @test */
    public function can_update_article()
    {
        $article = Article::factory()->create();

        $updateData = [
            'title' => 'Updated Title',
            'author' => 'Updated Author',
            'brief' => 'Updated brief summary',
            'full_text' => 'Updated full content'
        ];

        $response = $this->putJson("/api/v1/articles/{$article->id}", $updateData);

        $response->assertStatus(200)
            ->assertJsonFragment($updateData);

        $this->assertDatabaseHas('articles', $updateData);
    }

    /** @test */
    public function can_delete_article()
    {
        $article = Article::factory()->create();

        $response = $this->deleteJson("/api/v1/articles/{$article->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
    }

    /** @test */
    public function author_field_is_optional()
    {
        $data = [
            'title' => 'Article without Author',
            'brief' => 'Brief summary',
            'full_text' => 'Full content'
        ];

        $response = $this->postJson('/api/v1/articles', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('articles', $data);
    }
}
