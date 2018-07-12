<?php
return [

    'admin_base_url' => 'admin',

    'route' => [
        'redirectAuthenticated' => 'admin.dashboard',
    ],

    'view' => [
        'login' => 'admin::auth.login',
        'redirectAuthenticated' => 'admin::dashboard',
    ],

    'app_name' => 'Quiz',

    'generate_menu' => true, // this will generate
    'side_menu' => [
        'section_1' => [
            'name' => 'General',
            'items' => [
                'home' => [
                    'type' => 'dropdown',
                    'name' => 'Home',
                    'icon' => '<i class="fa fa-home"></i>',
                    'elements' => [
                        'dashboard1' => [
                            'type' => 'link',
                            'name' => 'Dashboard',
                            'route' => 'admin.dashboard',
                            'url' => '',
                        ],
//                        'dashboard2' => [
//                            'type' => 'link',
//                            'name' => 'Dashboard 2',
//                            'route' => 'admin.login',
//                            'url' => '',
//                        ]
                    ]
                ],
                'manage_admins' => [
                    'type' => 'dropdown',
                    'name' => 'Manage admins',
                    'icon' => '<i class="fa fa-users"></i>',
                    'elements' => [
                        'admins' => [
                            'type' => 'link',
                            'name' => 'Admins',
                            'route' => 'admin.admins.index',
                            'url' => '',
                        ],
                        'roles' => [
                            'type' => 'link',
                            'name' => 'Roles',
                            'route' => 'admin.roles.index',
                            'url' => '',
                        ]
                    ]
                ],
            ]
        ]
    ],

];
