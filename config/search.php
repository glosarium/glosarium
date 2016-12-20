<?php

return [
    'driver' => env('DB_CONNECTION'),
    'host' => env('DB_HOST'),
    'database' => env('DB_DATABASE'),
    'username' => env('DB_USERNAME'),
    'password' => env('DB_PASSWORD'),
    'storage' => storage_path('index')
];
