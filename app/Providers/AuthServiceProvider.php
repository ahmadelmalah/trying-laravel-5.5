<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\StackUser;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('have-admin-auth', function ($user) {
            //need to be updated
            return $user->id == 1;
        });

        Gate::define('update-stack', function ($user, $stack) {
            return $user->id == $stack->created_by;
        });

        Gate::define('stack-is-updatable', function ($user, $stack) {
            return $stack->type->id == 1;
        });

        Gate::define('stack-be-public', function ($user, $stack) {
            return $stack->type->id == 2;
        });

        Gate::define('use-stack', function ($user, $stack) {
            return count(StackUser::where('stack_id',$stack->id)->where('user_id', $user->id)->get()) == 1;
        });

        //
    }
}
