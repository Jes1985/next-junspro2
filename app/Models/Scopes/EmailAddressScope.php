<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Schema;

class EmailAddressScope implements Scope
{
    /**
     * Appliquer le scope à une requête Eloquent.
     */
    public function apply(Builder $builder, Model $model)
    {
        // Ne rien faire ici, on intercepte dans les méthodes where
    }

    /**
     * Intercepter les appels where('email', ...) et les transformer en where('email_address', ...)
     */
    public function extend(Builder $builder)
    {
        $builder->macro('whereEmail', function (Builder $builder, $value) {
            if (!Schema::hasColumn('users', 'email')) {
                return $builder->where('email_address', $value);
            }
            return $builder->where('email', $value);
        });
    }
}

