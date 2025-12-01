<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Laravel\Fortify\Features;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        parent::boot();

        //
    }

    /**
     * Register the configurations for Laravel Fortify.
     */
    protected function fortify(): void
    {
        Nova::fortify()
            ->features([
                Features::updatePasswords(),
                // Features::emailVerification(),
                // Features::twoFactorAuthentication(['confirm' => true, 'confirmPassword' => true]),
            ])
            ->register();
    }

    /**
     * Register the Nova routes.
     */
    protected function routes(): void
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->withoutEmailVerificationRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewNova', function (User $user) {
            // En environnement local, autoriser tous les utilisateurs
            if (app()->environment('local')) {
                return true;
            }
            
            // En production, autoriser selon le rôle ou l'email
            // Option 1 : Par email (ajoutez vos emails admin ici)
            $authorizedEmails = [
                'admin@junspro.com',
                // Ajoutez d'autres emails admin ici
            ];
            
            // Autoriser aussi les utilisateurs avec le rôle admin si la colonne existe
            if (Schema::hasColumn('users', 'role') && isset($user->role)) {
                if (in_array($user->role, ['admin', 'super_admin'])) {
                    return true;
                }
            }
            
            if (in_array($user->email, $authorizedEmails)) {
                return true;
            }
            
            // Option 2 : Par rôle (si vous avez un champ 'role' dans users)
            // Décommentez et adaptez selon votre structure :
            // if (isset($user->role) && in_array($user->role, ['admin', 'super_admin'])) {
            //     return true;
            // }
            
            // Option 3 : Par relation avec une table roles (si vous avez une relation)
            // if ($user->hasRole('admin')) {
            //     return true;
            // }
            
            return false;
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array<int, \Laravel\Nova\Dashboard>
     */
    protected function dashboards(): array
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array<int, \Laravel\Nova\Tool>
     */
    public function tools(): array
    {
        return [];
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        parent::register();

        //
    }
}
