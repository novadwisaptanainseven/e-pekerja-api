<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get Current User
        $user = Auth::user();

        // Cek apakah user bukan admin
        if ($user->level == 2) {
            // Jika user tidak memiliki level admin, maka teruskan
            return $next($request);
        } else {
            return response()->json([
                "message" => "Akses Ditolak!, hanya user non-admin yang boleh akses request"
            ], 403);
        }
    }
}
