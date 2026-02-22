<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next): Response
    {
        if ($request->query('lang')) {

            $locale = $request->query('lang');

            if (in_array($locale, ['fr','pt','en'])) {

                session(['app_locale' => $locale]);
                app()->setLocale($locale);
            }
        }

        if (session('app_locale')) {
            app()->setLocale(session('app_locale'));
        }

        return $next($request);
    }

}
