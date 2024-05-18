<?php

namespace App\Repositories;

use App\Interfaces\ArticleRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class CachedArticleRepository implements ArticleRepositoryInterface
{
    private $repository;
    private $cacheTime;

    public function __construct(ArticleRepositoryInterface $repository, int $cacheTime = 60)
    {
        $this->repository = $repository;
        $this->cacheTime = $cacheTime;
    }

    public function index(array $filters)
    {
        $cacheKey = 'articles.index.' . md5(json_encode($filters));
        return Cache::remember($cacheKey, $this->cacheTime, function () use ($filters) {
            return $this->repository->index($filters);
        });
    }

    public function show(int $id)
    {
        return Cache::remember("articles.{$id}", $this->cacheTime, function () use ($id) {
            return $this->repository->show($id);
        });
    }

    public function store(array $data)
    {
        $article = $this->repository->store($data);
        Cache::forget('articles.index.' . md5(json_encode([]))); // Clear the cache for the index method
        return $article;
    }

    public function update(array $data, int $id)
    {
        $result = $this->repository->update($data, $id);
        if ($result) {
            Cache::forget("articles.{$id}");
            Cache::forget('articles.index.' . md5(json_encode([]))); // Clear the cache for the index method
        }
        return $result;
    }

    public function delete(int $id): bool
    {
        $result = $this->repository->delete($id);
        if ($result) {
            Cache::forget("articles.{$id}");
            Cache::forget('articles.index.' . md5(json_encode([]))); // Clear the cache for the index method
        }
        return $result;
    }
}
