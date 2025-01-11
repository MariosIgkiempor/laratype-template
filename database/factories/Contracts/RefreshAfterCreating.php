<?php

declare(strict_types=1);

namespace Database\Factories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 */
trait RefreshAfterCreating
{
    /**
     * @return TModel|Collection<int, TModel>
     */
    final public function create($attributes = [], ?Model $parent = null)
    {
        /** @var TModel|Collection<int, TModel> $model */
        $model = parent::create($attributes, $parent);

        /** @var TModel|Collection<int, TModel> $freshModel */
        $freshModel = $model->fresh();

        return $freshModel;
    }
}
