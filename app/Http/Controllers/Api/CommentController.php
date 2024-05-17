<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;
use App\Tools\ResponseOutput\ResponseController;

class CommentController extends ResponseController
{
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $parmas = $request->validated();
        $parmas['user_id'] = auth()->id();

        return $this->respondCreated($this->commentRepository->store($parmas));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $parmas = $request->validated();

        return $this->respondUpdated($this->commentRepository->update($comment, $parmas));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        return $this->respondDeleted($this->commentRepository->delete($comment));
    }
}
