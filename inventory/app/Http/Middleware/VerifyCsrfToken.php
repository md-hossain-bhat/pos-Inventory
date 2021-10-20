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
        "admin/check-pwd","admin/update-admin-status","admin/update-supplier-status","admin/update-unit-status","admin/update-category-status","admin/update-product-status"
    ];
}
