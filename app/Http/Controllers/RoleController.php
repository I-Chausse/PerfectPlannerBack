<?php

namespace App\Http\Controllers;

use App\Http\Resources\DomainItemResource;
use App\Models\Role;
use Error;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function getRoles()
    {
        try {
            $roles = Role::all();
            return DomainItemResource::collection($roles);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }
}
