<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Dish;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('update-dish', function (User $user, Dish $dish) {
            return $user->id === $dish->user_id || $user->isAdmin();
        });

        Gate::define('delete-dish', function (User $user, Dish $dish) {
            return $user->isAdmin();
        });
    }
}
