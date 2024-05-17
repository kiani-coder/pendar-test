<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Comment;
use App\Models\Like;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_like_comment()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create();

        $response = $this->actingAs($user)
            ->postJson("/api/comments/{$comment->id}/like");

        $response->assertStatus(200)
                 ->assertJson([
                     'user_id' => $user->id,
                     'comment_id' => $comment->id,
                     'is_like' => true,
                 ]);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'comment_id' => $comment->id,
            'is_like' => true,
        ]);
    }

    public function test_user_can_dislike_comment()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create();

        $response = $this->actingAs($user)
            ->postJson("/api/comments/{$comment->id}/dislike");

        $response->assertStatus(200)
                 ->assertJson([
                     'user_id' => $user->id,
                     'comment_id' => $comment->id,
                     'is_like' => false,
                 ]);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'comment_id' => $comment->id,
            'is_like' => false,
        ]);
    }

    public function test_user_can_update_like_to_dislike()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create();

        $like = Like::factory()->create([
            'user_id' => $user->id,
            'comment_id' => $comment->id,
            'is_like' => true,
        ]);

        $response = $this->actingAs($user)
            ->postJson("/api/comments/{$comment->id}/dislike");

        $response->assertStatus(200)
                 ->assertJson([
                     'user_id' => $user->id,
                     'comment_id' => $comment->id,
                     'is_like' => false,
                 ]);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'comment_id' => $comment->id,
            'is_like' => false,
        ]);
    }

    public function test_user_can_update_dislike_to_like()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create();

        $dislike = Like::factory()->create([
            'user_id' => $user->id,
            'comment_id' => $comment->id,
            'is_like' => false,
        ]);

        $response = $this->actingAs($user)
            ->postJson("/api/comments/{$comment->id}/like");

        $response->assertStatus(200)
                 ->assertJson([
                     'user_id' => $user->id,
                     'comment_id' => $comment->id,
                     'is_like' => true,
                 ]);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'comment_id' => $comment->id,
            'is_like' => true,
        ]);
    }
}
