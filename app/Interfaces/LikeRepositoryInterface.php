<?php

namespace App\Interfaces;

interface LikeRepositoryInterface
{
    public function like(int $userId, int $commentId);

    public function dislike(int $userId, int $commentId);
}
