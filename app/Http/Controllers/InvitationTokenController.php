<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateInvitationTokenRequest;
use App\Http\Resources\TokenResource;
use App\Models\InvitationToken;
use Illuminate\Http\Request;

class InvitationTokenController extends Controller
{
    public function generate(GenerateInvitationTokenRequest $request)
    {
        try {
            // Créer le token
            $validatedData = $request->validated();
            $token = InvitationToken::create($validatedData);

            return new TokenResource($token);
        } catch (\Exception $e) {
            return response()->json(
                ["error" => "Erreur lors de la génération du token."],
                500
            );
        }
    }
}
