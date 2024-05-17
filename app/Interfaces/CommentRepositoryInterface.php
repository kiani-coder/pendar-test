<?php

namespace App\Interfaces;

use App\Models\Comment;

interface CommentRepositoryInterface
{
    public function store(array $data);

    public function update(Comment $comment, array $data);

    public function delete(Comment $comment);
}
