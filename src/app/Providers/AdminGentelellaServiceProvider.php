<?php

namespace LiteCode\AdminGentelella\App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;

class AdminGentelellaServiceProvider extends ServiceProvider
{
    protected $defer = false;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        Schema::defaultStringLength(191);

        if (!defined('ADMINGENTELELLA_PATH')) {
            define('ADMINGENTELELLA_PATH', realpath(__DIR__.'/../../'));
        }
        include ADMINGENTELELLA_PATH . '/routes/web.php';

        $this->publishes([
            ADMINGENTELELLA_PATH . '/database/migrations' => $this->app->databasePath() . '/migrations'
        ], 'migrations');

        $this->publishes([
            ADMINGENTELELLA_PATH . '/database/seeds' => $this->app->databasePath() . '/seeds'
        ], 'seeds');

        if(file_exists(ADMINGENTELELLA_PATH . '/config/adminauth.php') == false){
            $this->publishes([
                ADMINGENTELELLA_PATH . '/config/adminauth.php' => config_path('adminauth.php')
            ], 'config');
        }


        $this->publishes([
            ADMINGENTELELLA_PATH . '/resources/assets/' => public_path()
        ], 'assets');

        $this->mergeConfigFrom(ADMINGENTELELLA_PATH . '/config/authGuards.php', 'auth.guards');
        $this->mergeConfigFrom(ADMINGENTELELLA_PATH . '/config/authProvider.php', 'auth.providers');
        $this->mergeConfigFrom(ADMINGENTELELLA_PATH . '/config/authPassword.php', 'auth.passwords');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if (!defined('ADMINGENTELELLA_PATH')) {
            define('ADMINGENTELELLA_PATH', realpath(__DIR__.'/../../'));
        }
        /* REGISTER EXCEPTION HANDLER FOR guard: "auth:admin" - solve redirect if unauthenticated user hit admin url */
        $this->app->singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            \LiteCode\AdminGentelella\App\Exceptions\AdminauthHandler::class
        );

        /* THIS ONES WILL REGISTER INTO: app\Http\Kernel.php => protected $middlewareGroups = []; */
        $this->app['router']->pushMiddlewareToGroup('admin', \App\Http\Middleware\EncryptCookies::class);
        $this->app['router']->pushMiddlewareToGroup('admin', \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class);
        $this->app['router']->pushMiddlewareToGroup('admin', \Illuminate\Session\Middleware\StartSession::class);
        $this->app['router']->pushMiddlewareToGroup('admin', \Illuminate\View\Middleware\ShareErrorsFromSession::class);
        $this->app['router']->pushMiddlewareToGroup('admin', \App\Http\Middleware\VerifyCsrfToken::class);
        $this->app['router']->pushMiddlewareToGroup('admin', \Illuminate\Routing\Middleware\SubstituteBindings::class);

        /* THIS ONE WILL REGISTER INTO: app\Http\Kernel.php => protected $routeMiddleware = []; */
        $this->app['router']->aliasMiddleware('admin', \LiteCode\AdminGentelella\App\Http\Middleware\RedirectAuthenticatedAdmin::class);
        $this->app['router']->aliasMiddleware('role', \Spatie\Permission\Middlewares\RoleMiddleware::class);
        $this->app['router']->aliasMiddleware('permission', \Spatie\Permission\Middlewares\PermissionMiddleware::class);

        $this->commands([
            \LiteCode\AdminGentelella\App\Console\Commands\liteAdmin ::class,
            \LiteCode\AdminGentelella\App\Console\Commands\liteDropPackageTables ::class,
            \LiteCode\AdminGentelella\App\Console\Commands\liteDropTables ::class,
            \LiteCode\AdminGentelella\App\Console\Commands\dropTables ::class,
            \LiteCode\AdminGentelella\App\Console\Commands\liteInstall ::class,
        ]);

        // register views
        $this->loadViewsFrom(base_path() . '/resources/views/backend/', 'admin');
        $this->loadViewsFrom(ADMINGENTELELLA_PATH . '/resources/views/backend/', 'admin');
        $this->loadViewsFrom(ADMINGENTELELLA_PATH . '/resources/views/crud/', 'admin');

    }

}
