<?php

namespace App\Filters\Article;

use App\Filters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;

class TitleFilter extends BaseFilter
{
    public function apply(Builder $builder, $value)
    {
        return $builder->where('title', 'like', '%' . $value . '%');
    }
}
