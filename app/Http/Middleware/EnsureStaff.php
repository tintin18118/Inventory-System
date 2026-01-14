<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;

class EnsureStaff
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
dd($user);


        if (!$user || !$user->isStaff()) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
