<?php

namespace App\Http\Controllers;

use App\Http\Resources\DomainItemResource;
use App\Models\Domain;
use App\Models\DomainItem;
use Error;

class DomainItemController extends Controller
{
    public function getByDomain($domain)
    {
        try {
            $domain = Domain::where("code", $domain)->first();
            if ($domain) {
                $domainItems = DomainItem::where(
                    "domain_id",
                    $domain->id
                )->get();
            } else {
                return response()->json(["message" => "Domain not found"], 404);
            }
            return DomainItemResource::collection($domainItems);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }
}
