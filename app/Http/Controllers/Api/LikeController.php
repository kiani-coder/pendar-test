<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\LikeRepositoryInterface;
use App\Models\Comment;
use App\Tools\ResponseOutput\ResponseController;

class LikeController extends ResponseController
{
    protected $likeRepository;

    public function __construct(LikeRepositoryInterface $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    public function like(Comment $comment)
    {
        $like = $this->likeRepository->like(auth()->id(), $comment->id);

        return $this->respond($like);
    }

    public function dislike(Comment $comment)
    {
        $dislike = $this->likeRepository->dislike(auth()->id(), $comment->id);

        return $this->respond($dislike);
    }
}
