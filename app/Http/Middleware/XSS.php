<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class XSS
 */
class XSS
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->route()->getName() == 'cms.update') {
            return $next($request);
        }

        $input = $request->all();
        array_walk_recursive($input, function (&$input) {
            $input = (is_null($input)) ? null : strip_tags($input);
        });
        $request->merge($input);

        return $next($request);
    }
}
