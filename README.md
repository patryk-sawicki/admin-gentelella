## LiteCode - Admin Gantellela

- - - -

### Installation
````
    composer require lite-code/adminagantelella
    php artisan vendor:publish --provider="LiteCode\Admingantellela\App\Providers\AdmingantellelaServiceProvider" /* --force */
    php artisan migrate --seed OR php artisan migrate:refresh --seed
````

##### This package includes guard:admin, login page, migration + seed table:admin, config:adminauth
After vendor:publish check configuration file in /config/adminauth.php

##### Override views
Add this to your ServiceProvider boot()
````
$this->app['view']->addNamespace('admin', base_path() . '/resources/views/backend');
````
