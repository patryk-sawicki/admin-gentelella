<?php
return [

        'admins' => [
            'driver' => 'eloquent',
            'model' => env('LITE_ADMIN_MODEL'.'::class', LiteCode\AdminGentelella\App\Models\Admin::class),
        ]
];
