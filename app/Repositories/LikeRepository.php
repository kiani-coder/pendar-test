<?php

namespace App\Repositories;

use App\Interfaces\LikeRepositoryInterface;
use App\Models\Like;

class LikeRepository implements LikeRepositoryInterface
{
    public function like($userId, $commentId)
    {
        return Like::updateOrCreate(
            ['user_id' => $userId, 'comment_id' => $commentId],
            ['is_like' => true]
        );
    }

    public function dislike($userId, $commentId)
    {
        return Like::updateOrCreate(
            ['user_id' => $userId, 'comment_id' => $commentId],
            ['is_like' => false]
        );
    }
}
