<?php

namespace App\Http\Middleware;

use App\Support\Locale;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->filled('lang') && array_key_exists($request->query('lang'), Locale::all())) {
            Locale::set($request->query('lang'));
        } else {
            app()->setLocale(Locale::current());
        }

        return $next($request);
    }
}
