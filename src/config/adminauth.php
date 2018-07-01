<?php
return [

    'route' => [
        'redirectAuthenticated' => 'admin::dashboard',
    ],

    'view' => [
        'login' => 'admin::auth.login',
        'redirectAuthenticated' => 'admin::dashboard',
    ]


];
