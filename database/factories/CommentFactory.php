<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'commentable_id' => Article::factory(),
            'commentable_type' => 'App\Models\Article',
            'content' => $this->faker->sentence,
        ];
    }
}
