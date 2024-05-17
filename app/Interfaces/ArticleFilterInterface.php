<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Builder;

interface ArticleFilterInterface
{
    public function apply(Builder $builder, $value);
}
