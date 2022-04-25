<?php
use App\Controllers\CreateController;
use App\Controllers\AuthController;
return [
    'api/create' => [
        ['method' => 'POST', 'handler' => [CreateController::class, 'create']],
        ['method' => 'GET', 'handler' => [CreateController::class, 'getAllUrls']],
    ],
    'api/auth' => [
        ['method' => 'POST', 'handler' => [AuthController::class, 'login']],
        ['method' => 'GET', 'handler' => [AuthController::class, 'login']]
    ]
];