<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserAssignedToUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin = Auth::user();
        $userId = $request->route("user_id");
        $authorized = $admin->assignees()->where("users.id", $userId)->exists();
        if (!$authorized) {
            return response()->json(["message" => "Unauthorized"], 403);
        }
        return $next($request);
    }
}
