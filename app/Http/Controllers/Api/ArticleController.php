<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Http\Resources\Article\ArticleCollection;
use App\Http\Resources\Article\ArticleResource;
use Illuminate\Http\Request;
use App\Interfaces\ArticleRepositoryInterface;
use App\Jobs\SendArticleCreatedEmail;
use App\Tools\ResponseOutput\ResponseController;
use Illuminate\Support\Facades\Storage;

class ArticleController extends ResponseController
{
    protected $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Display a listing of the articles.
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $articles = $this->articleRepository->index($request->all());
        return $this->respondWithPagination(new ArticleCollection($articles));
    }

    /**
     * Display the specified article.
     *
     * @param int $id
     */
    public function show($id)
    {
        $article = $this->articleRepository->show($id);
        return $this->respond(new ArticleResource($article));
    }

    /**
     * Store a newly created article in storage.
     *
     * @param Request $request
     */
    public function store(StoreArticleRequest $request)
    {
        $parmas = $request->validated();
        $parmas['image_path'] = Storage::disk('s3')->put('articles', $request->file('image'));

        $article = $this->articleRepository->store($parmas);

        // send email notification
        SendArticleCreatedEmail::dispatch($article)->onQueue('emails');

        return $this->respondCreated($article);
    }

    /**
     * Update the specified article in storage.
     *
     * @param Request $request
     * @param int $id
     */
    public function update(UpdateArticleRequest $request, $id)
    {
        $params = $request->validated();
        if ($request->hasFile('image')) {
            $params['image_path'] = Storage::disk('s3')->put('articles', $request->file('image'));
        }

        return $this->respondUpdated($this->articleRepository->update($params, $id));
    }

    /**
     * Remove the specified article from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        return $this->respondDeleted($this->articleRepository->delete($id));
    }
}
