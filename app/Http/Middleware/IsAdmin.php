<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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

        // Cek apakah user adalah admin
        if ($user->level == 1) {
            // Jika iya, maka access url diteruskan
            return $next($request);
        } else {
            // Jika bukan maka access forbidden 403
            return response()->json([
                "message" => "Akses Ditolak!, Anda Bukan Admin"
            ], 403);
        }
    }
}
