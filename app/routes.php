<?php
use App\Controllers\CreateController;
use App\Controllers\AuthController;
use App\Controllers\RedirectsHistoryController;
return [
    'api/create' => [
        ['method' => 'POST', 'handler' => [CreateController::class, 'create']],
        ['method' => 'GET', 'handler' => [CreateController::class, 'getUrlsList']],
        ['method' => 'PUT', 'handler' => [CreateController::class, 'updateUrl']],
        ['method' => 'DELETE', 'handler' => [CreateController::class, 'deleteUrl']]
    ],
    'api/auth' => [
        ['method' => 'POST', 'handler' => [AuthController::class, 'login']]
    ],
    'api/redirects/history' => [
        ['method' => 'GET', 'handler' => [RedirectsHistoryController::class, 'getRedirectsHistory']]
    ]
];