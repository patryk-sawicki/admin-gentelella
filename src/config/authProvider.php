<?php
return [

        'admins' => [
            'driver' => 'eloquent',
            'model' => env('LITE_ADMIN_MODEL', LiteCode\AdminGentelella\App\Models\Admin::class),
        ]
];
