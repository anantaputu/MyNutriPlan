<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika pengguna belum login sama sekali, arahkan ke halaman login.
        if (!Auth::check()) {
            return redirect('login');
        }

        // Ambil peran (role) dari pengguna yang sedang login.
        $userRole = Auth::user()->role;

        // Periksa apakah peran pengguna ada di dalam daftar peran yang diizinkan ($roles).
        if (in_array($userRole, $roles)) {
            // Jika ya, izinkan akses ke halaman berikutnya.
            return $next($request);
        }

        // Jika peran pengguna tidak diizinkan, kembalikan response "403 Forbidden".
        // Ini lebih baik daripada redirect, karena memberitahu bahwa mereka tidak punya hak akses.
        abort(403, 'UNAUTHORIZED ACTION.');
    }
}