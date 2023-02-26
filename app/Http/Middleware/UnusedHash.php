<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Hash;
use Illuminate\Http\Request;

class UnusedHash
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
        $hash_already_registered = Hash::where('hash', $request->hash)->where('was_used', true)->exists();

        if($hash_already_registered)
            return redirect()->route('denied');

        return $next($request);
    }
}
