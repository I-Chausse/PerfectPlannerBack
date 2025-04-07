<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDomainItemRequest;
use App\Http\Requests\UpdateDomainItemRequest;
use App\Models\Domain;
use App\Models\DomainItem;

class DomainItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDomainItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DomainItem $domainItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DomainItem $domainItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDomainItemRequest $request, DomainItem $domainItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DomainItem $domainItem)
    {
        //
    }

    public function getByDomain($domain)
    {
        $domain = Domain::where('code', $domain)->first();
        if ($domain) {
            $domainItems = DomainItem::where('domain_id', $domain->id)->get();
        } else {
            return response()->json(['message' => 'Domain not found'], 404);
        }
        return response()->json($domainItems);
    }
}
