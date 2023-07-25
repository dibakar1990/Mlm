<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function unauthenticated($request, array $guards)
    {
        if (Str::contains($request->route()->getPrefix(), 'api')) {
            throw new AuthenticationException(
                'Unauthenticated.', $guards
            );
        }

        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectTo($request)
        );
    }

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (Str::contains($request->route()->getPrefix(), 'admin')) {
                 return route('admin.login');
             }
         }
    }
}
