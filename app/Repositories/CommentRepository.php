<?php

namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    public function store(array $data)
    {
        return Comment::create($data);
    }

    public function update(Comment $comment, array $data)
    {
        $comment->update($data);
        return $comment;
    }

    public function delete(Comment $comment)
    {
        return $comment->delete();
    }
}
