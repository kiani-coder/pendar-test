<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    protected $model = Like::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'comment_id' => Comment::factory(),
            'is_like' => $this->faker->boolean,
        ];
    }
}
