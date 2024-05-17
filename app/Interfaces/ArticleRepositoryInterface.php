<?php

namespace App\Interfaces;

interface ArticleRepositoryInterface
{
    /**
     * Get a paginated list of articles based on provided filters.
     *
     * @param array $filters
     */
    public function index(array $filters);

    /**
     * Get the article with the given ID.
     *
     * @param int $id
     */
    public function show(int $id);

    /**
     * Store a new article in the database.
     *
     * @param array $data
     */
    public function store(array $data);

    /**
     * Update the article with the given ID.
     *
     * @param array $data
     * @param int $id
     */
    public function update(array $data, int $id);

    /**
     * Delete the article with the given ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
