<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDomainItemRequest;
use App\Http\Requests\UpdateDomainItemRequest;
use App\Http\Resources\DomainItemRessource;
use App\Models\Domain;
use App\Models\DomainItem;

class DomainItemController extends Controller
{
    public function getByDomain($domain)
    {
        $domain = Domain::where('code', $domain)->first();
        if ($domain) {
            $domainItems = DomainItem::where('domain_id', $domain->id)->get();
        } else {
            return response()->json(['message' => 'Domain not found'], 404);
        }
        return DomainItemRessource::collection($domainItems);
    }
}
