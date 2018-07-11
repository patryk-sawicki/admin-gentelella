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

    'generate_menu' => true,
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
                        'dashboard2' => [
                            'type' => 'link',
                            'name' => 'Dashboard 2',
                            'route' => 'admin.login',
                            'url' => '',
                        ]
                    ]
                ],
                'forms' => [
                    'type' => 'dropdown',
                    'name' => 'Forms',
                    'icon' => '<i class="fa fa-edit"></i>',
                    'elements' => [
                        'general_form' => [
                            'type' => 'link',
                            'name' => 'General Forms',
                            'route' => 'admin.login',
                            'url' => '',
                        ],
                        'form_validation' => [
                            'type' => 'link',
                            'name' => 'Form Validation',
                            'route' => 'admin.login',
                            'url' => '',
                        ]
                    ]
                ],
                'single_link' => [
                    'type' => 'link',
                    'name' => 'Single link',
                    'icon' => '<i class="fa fa-link"></i>',
                    'route' => 'admin.login',
                    'url' => '',
                ]
            ]

        ]
    ],

];
