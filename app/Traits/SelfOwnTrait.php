<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait SelfOwnTrait
{
    public static function bootSelfOwnTrait()
    {
        if (! app()->runningInConsole() && auth()->check()) {
            $isAdmin = auth()->user()->roles->contains(1);
            static::creating(function ($model) use ($isAdmin) {
                // Prevent admin from setting his own id - admin entries are global.
                // If required, remove the surrounding IF condition and admins will act as users
                if (! $isAdmin) {
                    $model->user_id = auth()->id();
                }
            });
            if (! $isAdmin) {
                static::addGlobalScope('user_id', function (Builder $builder) {
                    $field = sprintf('%s.%s', $builder->getQuery()->from, 'user_id');

                    $builder->where($field, auth()->id())->orWhereNull($field);
                });
            }
        }
    }
}
