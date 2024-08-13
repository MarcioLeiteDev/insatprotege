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

        '/escritorio/enderecos/store',
        '/escritorio/enderecos/update/*',
        '/escritorio/enderecos/delete/*',

        '/escritorio/telefones/store',
        '/escritorio/telefones/update/*',
        '/escritorio/telefones/delete/*',

        '/escritorio/veiculos/store',
        '/escritorio/veiculos/update/*',
        '/escritorio/veiculos/delete/*',
        '/escritorio/fipe/marca',
        '/escritorio/fipe/modelo',
    ];
}
