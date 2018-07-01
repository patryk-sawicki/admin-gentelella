# OCAuth

- - - -

### Installation
````
    composer require militaruc/adminauth
    php artisan vendor:publish --provider="MilitaruC\Adminauth\App\Providers\AdminauthServiceProvider" /* --force */
    php artisan migrate --seed OR php artisan migrate:refresh --seed
````

##### This package includes guard:admin, login page, migration + seed table:admin, config:adminauth
After vendor:publish check configuration file in /config/adminauth.php
