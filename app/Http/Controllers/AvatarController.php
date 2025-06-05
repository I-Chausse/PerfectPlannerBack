<?php

namespace App\Http\Controllers;

use App\Http\Resources\AvatarResource;
use App\Models\Avatar;
use Error;

class AvatarController extends Controller
{
    public function index() {
        try {
            $avatars = Avatar::all();
            return AvatarResource::collection($avatars);
        }
        catch (Error $e) {}
    }
}
