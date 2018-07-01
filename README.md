## LiteCode - Admin Genterella

- - - -
Created from: https://github.com/puikinsh/gentelella
Official preview of Genterella: https://colorlib.com/polygon/gentelella/index.html
### Installation
````
    composer require lite-code/adminagentelella
    php artisan vendor:publish --provider="LiteCode\Admingantellela\App\Providers\AdmingantellelaServiceProvider" /* --force */
    php artisan migrate --seed OR php artisan migrate:refresh --seed
````

- - - -

#### This package includes guard:admin, login page, migration + seed table:admin, config:adminauth
After vendor:publish check configuration file in /config/adminauth.php

- - - -

#### Extend admin views
Use this in blade
````
@extends('admin::layouts.gentelella')

@section('content')
    {{'Your content here'}}
@endsection
````

- - - -

#### Override views
Add this to your ServiceProvider boot()
````
$this->app['view']->addNamespace('admin', base_path() . '/resources/views/backend');
````
