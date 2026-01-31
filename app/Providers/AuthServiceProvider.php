<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\UserPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\RolePolicy;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
// use Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic;
// use App\Policies\RouteStatisticPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [

       // 'Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic' => 'App\Policies\RouteStatisticPolicy',
       // 'App\Models\User' => 'App\Policies\UserPolicy'
      //  User::class => UserPolicy::class,
      Role::class => RolePolicy::class,
      Permission::class => PermissionPolicy::class,
      // RouteStatistic::class => RouteStatisticPolicy::class

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        $this->registerPolicies();
     //   Gate::before(function (User $user, string $ability) {
      //      return $user->isSuperAdmin() ? true: null;
      //  });
    }
}
