<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectTrailingSlash
{
    /**
     * Handle an incoming request.
     * Enforce strict 301 redirect for trailing slashes to prevent internal duplicate indexing.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->getPathInfo();

        if ($path !== '/' && str_ends_with($path, '/')) {
            $cleanPath = rtrim($path, '/');
            $queryString = $request->getQueryString();
            $targetUrl = $request->getSchemeAndHttpHost() . $cleanPath . ($queryString ? '?' . $queryString : '');

            return redirect()->to($targetUrl, 301);
        }

        return $next($request);
    }
}
