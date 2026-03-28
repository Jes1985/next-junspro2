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
            try {
                // En environnement local, autoriser tous les utilisateurs
                if (app()->environment('local')) {
                    return true;
                }
                
                // Récupérer l'email (gérer les deux cas : email ou email_address)
                $userEmail = null;
                if (isset($user->email)) {
                    $userEmail = $user->email;
                } elseif (isset($user->email_address)) {
                    $userEmail = $user->email_address;
                } elseif (Schema::hasColumn('users', 'email')) {
                    $userEmail = $user->email;
                } elseif (Schema::hasColumn('users', 'email_address')) {
                    $userEmail = $user->email_address;
                }
                
                // En production, autoriser selon le rôle ou l'email
                $authorizedEmails = [
                    'admin@junspro.com',
                    // Ajoutez d'autres emails admin ici
                ];
                
                // Vérifier par email
                if ($userEmail && in_array($userEmail, $authorizedEmails)) {
                    return true;
                }
                
                // Autoriser aussi les utilisateurs avec le rôle admin si la colonne existe
                if (Schema::hasColumn('users', 'role') && isset($user->role)) {
                    if (in_array($user->role, ['admin', 'super_admin'])) {
                        return true;
                    }
                }
                
                return false;
            } catch (\Exception $e) {
                // En cas d'erreur, autoriser en local pour le debug
                \Log::error('Nova gate error: ' . $e->getMessage());
                return app()->environment('local');
            }
        });
    }

    /**
     * Déclarer explicitement les resources Nova — évite les problèmes d'auto-discover
     *
     * @return array<int, class-string<\Laravel\Nova\Resource>>
     */
    public function resources(): array
    {
        return [
            \App\Nova\PsAmbassadeur::class,
            \App\Nova\PsConversion::class,
            \App\Nova\PsTestimonial::class,
        ];
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
