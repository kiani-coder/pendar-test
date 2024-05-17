<?php

namespace App\Filters;

use App\Interfaces\ArticleFilterInterface;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseFilter implements ArticleFilterInterface
{
    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }
}
