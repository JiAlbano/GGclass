<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;


class kernel extends HttpKernel
{
    protected $routeMiddleware = [

        'check.google' => \App\Http\Middleware\CheckGoogleOAuth::class,
        // Other middleware...
        'check.user.type' => \App\Http\Middleware\CheckUserType::class,

    ];
}
