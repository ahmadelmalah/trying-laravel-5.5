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

        Gate::define('update-stack', function ($user, $stack) {
            return $user->id == $stack->created_by;
        });

        Gate::define('use-stack', function ($user, $stack) {
            return count(StackUser::where('stack_id',$stack->id)->where('user_id', $user->id)->get()) == 1;
        });

        //
    }
}
