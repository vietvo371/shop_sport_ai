<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Helpers\ApiResponse;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $permission
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = $request->user();

        // Tài khoản master và legacy admin có full access
        if ($user->is_master || $user->vai_tro === 'quan_tri') {
            return $next($request);
        }

        if (!$user || !$user->hasPermission($permission)) {
            return ApiResponse::error('Bạn không có quyền thực hiện hành động này.', 403);
        }

        return $next($request);
    }
}
