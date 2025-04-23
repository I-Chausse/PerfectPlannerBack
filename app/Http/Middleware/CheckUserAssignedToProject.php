<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserAssignedToProject
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $projectId = $request->route("project_id");

        // Vérifiez si l'utilisateur est assigné au projet
        $project = Project::find($projectId);

        if (
            !$project ||
            (!$project->users()->where("users.id", $user->id)->exists() &&
                !$project->admins()->where("users.id", $user->id)->exists())
        ) {
            return response()->json(["message" => "Unauthorized"], 403);
        }
        return $next($request);
    }
}
