<?php

namespace Star\MCenter;

use Illuminate\Support\ServiceProvider;
use Star\MCenter\Commands\CreatePermission;
use Star\MCenter\Commands\CreateRole;
use Star\MCenter\Commands\MCenterSetup;
use Star\MCenter\Contracts\Permissions\Role as RoleContract;
use Star\MCenter\Contracts\Permissions\Permission as PermissionContract;

class MCenterServiceProvider extends ServiceProvider
{
    public function boot(PermissionRegistrar $permissionLoader)
    {
        $this->publishes([
            __DIR__ . '/../config/permission.php' => config_path('permission.php'),
        ], 'mcenter');


        if (!class_exists('CreatePermissionTables')) {
            $timestamp = '1977_07_15_000000';

            $this->publishes([
                __DIR__ . '/../database/migrations/create_permission_tables.php.stub' => $this->app->databasePath() . "/migrations/{$timestamp}_create_permission_tables.php",
            ], 'mcenter');

            $this->publishes([
                __DIR__ . '/../database/migrations/create_wemesh_tables.php.stub' => $this->app->databasePath() . "/migrations/{$timestamp}_create_wemesh_tables.php"
            ], 'mcenter');

            $this->publishes([
                __DIR__ . '/../database/seeds/MCenterSeeder.php' => $this->app->databasePath() . "/seeds/MCenterSeeder.php"
            ], 'mcenter');
        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateRole::class,
                CreatePermission::class,
                MCenterSetup::class,
            ]);
        }

        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        $this->registerModelBindings();

        $permissionLoader->registerPermissions();

    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/permission.php',
            'mcenter'
        );

    }

    protected function registerModelBindings()
    {
        $this->app->bind(PermissionContract::class, 'permission');
        $this->app->bind(RoleContract::class, 'role');
    }

}