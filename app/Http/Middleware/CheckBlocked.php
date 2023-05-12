<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->isBlocked()) {
            return redirect()->route('blockPage')->with('error', 'Your account is blocked.');
        }

        if($user && $user->isAdmin()){
            abort(403, 'Unauthorized action.');
        }
        
        return $next($request);
    }
}
