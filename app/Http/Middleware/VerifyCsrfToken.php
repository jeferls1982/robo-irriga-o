<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/api/paises',
        '/api/paises/*',
        '/api/estados',
        '/api/estados/*',
        '/api/empresas',
        '/api/empresas/*',
        '/api/cidade_empresa',
        '/api/cidade_empresa/*'
    ];
}
