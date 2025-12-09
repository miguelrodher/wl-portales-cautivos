<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token_enviado = $request->header('X-API-KEY');
        $token_real = env('API_KEY');

        if ($token_enviado !== $token_real) 
        {
            return response()->json(['message' => 'Acceso no autorizado.'], 401);        
        }
        return $next($request);
    }
}
