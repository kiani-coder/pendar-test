<?php

namespace App\Models;

use App\Exceptions\InvalidFilterException;
use App\Interfaces\ArticleFilterInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image_path'];

    public function scopeFilter($query, $filters)
    {
        foreach ($filters as $filterName => $value) {
            if ($filterName === 'perPage') {
                continue; // Skip handling 'perPage' filter
            }

            $filterClass = 'App\\Filters\\Article\\' . ucfirst($filterName) . 'Filter';

            if (!class_exists($filterClass)) {
                throw new InvalidFilterException("Invalid filter: $filterName");
            }

            $filter = new $filterClass($query);

            if (!$filter instanceof ArticleFilterInterface) {
                throw new InvalidFilterException("Invalid filter implementation: $filterClass");
            }

            $filter->apply($query, $value);
        }

        return $query;
    }
}
