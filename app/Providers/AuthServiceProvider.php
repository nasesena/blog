<?php

namespace app\Providers;

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
        'app\Model' => 'app\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
         // 開発者のみ許可、ロールが1。
    Gate::define('system-only', function ($user) {
    return ($user->role == 1);
    });
  // 管理者以上（管理者＆システム管理者）に許可
    Gate::define('admin-higher', function ($user) {
    return ($user->role == 29);
    });
  // 一般ユーザ以上（つまり全権限）に許可
    Gate::define('user-higher', function ($user) {
    return ($user->role == 2);
    });

        //
    }
}
