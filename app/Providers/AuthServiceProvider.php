<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
        // 自动发现策略
        Gate::guessPolicyNamesUsing(function ($modelClass) {
            $arr = explode('\\', $modelClass);
            return 'App\\Policies\\' . $arr[count($arr) - 1] . 'Policy';
        });

        $this->registerPolicies();

        //
    }
}
