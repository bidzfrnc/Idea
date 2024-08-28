<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Idea;
use App\Models\User;
// use App\Policies\IdeaPermissions;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
      //  Idea::class => IdeaPermissions::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Gates => Permission or Simple Role

        //ROLE
        Gate::define('admin', function(User $user) : bool{
            return (bool) $user->is_admin;
        });

        // //PERMISSION
        // //DELETE
        // Gate::define('idea.delete', function(User $user, Idea $idea) : bool{
        //     return ((bool) $user->is_admin || $user->id === $idea->user_id);
        // });

        // //EDIT
        // Gate::define('idea.edit', function(User $user, Idea $idea) : bool{
        // return ((bool) $user->is_admin || $user->id === $idea->user_id);
        // });
    }
}

