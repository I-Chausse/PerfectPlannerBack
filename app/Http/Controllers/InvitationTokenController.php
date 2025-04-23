<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateInvitationTokenRequest;
use App\Http\Resources\TokenResource;
use App\Models\InvitationToken;

class InvitationTokenController extends Controller
{
    public function generate(GenerateInvitationTokenRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $token = InvitationToken::create($validatedData);

            return new TokenResource($token);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "error" => "Erreur lors de la génération du token.",
                    "message" => $e->getMessage(),
                ],
                500
            );
        }
    }
}
