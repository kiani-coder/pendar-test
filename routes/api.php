<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

Route::apiResource('articles', ArticleController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('comments', CommentController::class);
    Route::post('comments/{comment}/like', [LikeController::class, 'like']);
    Route::post('comments/{comment}/dislike', [LikeController::class, 'dislike']);
});
