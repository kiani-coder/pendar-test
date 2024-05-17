<?php

namespace App\Repositories;

use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;

class ArticleRepository implements ArticleRepositoryInterface
{
    /**
     * Retrieve a paginated list of articles based on provided filters.
     *
     * @param array $filters
     */
    public function index(array $filters)
    {
        $perPage = $filters['perPage'] ?? config('per_page', 10);

        return Article::filter($filters)->paginate($perPage);
    }

    /**
     * Find an article by its ID.
     *
     * @param int $id
     */
    public function show(int $id)
    {
        return Article::findOrFail($id);
    }

    /**
     * Store a new article in the database.
     *
     * @param array $data
     */
    public function store(array $data)
    {
        return Article::create($data);
    }

    /**
     * Update an existing article in the database.
     *
     * @param array $data
     * @param int $id
     */
    public function update(array $data, int $id)
    {
        Article::where('id', $id)->update($data);
        return $this->show($id);
    }

    /**
     * Delete an article from the database.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return Article::destroy($id);
    }
}
