<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_comment()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create();

        $this->actingAs($user)
            ->postJson('/api/comments', [
                'commentable_id' => $article->id,
                'commentable_type' => 'App\Models\Article',
                'content' => 'This is a test comment',
            ])
            ->assertStatus(201);
    }

    public function test_user_can_update_comment()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->putJson("/api/comments/{$comment->id}", [
                'content' => 'Updated comment content',
            ])
            ->assertStatus(200);
    }

    public function test_user_can_delete_comment()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->deleteJson("/api/comments/{$comment->id}")
            ->assertStatus(204);
    }
}
