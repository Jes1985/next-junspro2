<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Hash;

class CustomUserProvider implements UserProvider
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function retrieveById($identifier)
    {
        return $this->model->find($identifier);
    }

    public function retrieveByToken($identifier, $token)
    {
        $model = $this->model;
        return $model->where($model->getAuthIdentifierName(), $identifier)
            ->where('remember_token', $token)
            ->first();
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        $user->setRememberToken($token);
        $user->save();
    }

    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials)) {
            return null;
        }

        $query = $this->model->newQuery();

        // Détecte dynamiquement la colonne email selon le schéma de la base
        $emailColumn = \Illuminate\Support\Facades\Schema::hasColumn('users', 'email') ? 'email' : 'email_address';

        if (isset($credentials['email'])) {
            $query->where($emailColumn, $credentials['email']);
            unset($credentials['email']);
        } elseif (isset($credentials['email_address'])) {
            $query->where($emailColumn, $credentials['email_address']);
            unset($credentials['email_address']);
        }

        // Gérer 'username' si présent
        if (isset($credentials['username'])) {
            $query->where('username', $credentials['username']);
            unset($credentials['username']);
        }

        // Ajouter les autres conditions
        foreach ($credentials as $key => $value) {
            if (str_contains($key, 'password')) {
                continue;
            }
            $query->where($key, $value);
        }

        return $query->first();
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $plain = $credentials['password'] ?? null;
        return $plain && Hash::check($plain, $user->getAuthPassword());
    }

    /**
     * Rehash the user's password if required and supported.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @param  bool  $force
     * @return void
     */
    public function rehashPasswordIfRequired(Authenticatable $user, array $credentials, bool $force = false): void
    {
        $plain = $credentials['password'] ?? null;

        if (!$plain) {
            return;
        }

        // Rehash si nécessaire (algorithme obsolète ou force=true)
        if ($force || Hash::needsRehash($user->getAuthPassword())) {
            $user->setAuthPassword(Hash::make($plain));
            $user->save();
        }
    }
}

