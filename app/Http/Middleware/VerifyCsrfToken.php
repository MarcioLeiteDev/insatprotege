<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/escritorio/users/store',
        '/escritorio/users/show/*',
        '/escritorio/users/update/*',
        '/escritorio/users/delete/*',

        '/escritorio/pessoas/store',
        '/escritorio/pessoas/update/*',
        '/escritorio/pessoas/delete/*',
    ];
}
