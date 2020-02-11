<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-users', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('edit-users', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('delete-users', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('manage-blogs', function($user){
            return $user->hasRole('author');
        });

        Gate::define('read-blogs', function($user){
            return $user->hasAnyRoles(['author', 'user']);
        });

        Gate::define('edit-blogs', function($user){
            return $user->hasRole('author');
        });

        Gate::define('delete-blogs', function($user){
            return $user->hasRole('author');
        });

        Gate::define('manage-comments', function($user){
            return $user->hasRole('user');
        });

        
        Gate::define('read-comments', function($user){
            return $user->hasAnyRoles(['author', 'user']);
        });

        Gate::define('edit-comments', function($user){
            return $user->hasRole('user');
        });

        Gate::define('delete-comments', function($user){
            return $user->hasRole('user');
        });

    }
}
