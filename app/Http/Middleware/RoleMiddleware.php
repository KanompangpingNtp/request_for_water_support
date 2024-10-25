<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // ตรวจสอบว่า user มีการ login และมี role ตรงกับที่กำหนดหรือไม่
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // หากไม่ตรงให้ redirect ไปที่หน้า login หรือหน้าอื่นที่ต้องการ
        return redirect()->route('login')->with('error', 'Access Denied.');
    }
}
