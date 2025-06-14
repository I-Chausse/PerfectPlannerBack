<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "remaining_time" => $this->remaining_time,
            "project_id" => $this->project_id,
            "status" => $this->status,
            "domain_item_status_id" => $this->domain_item_status_id,
            "domain_item_flag_id" => $this->domain_item_flag_id,
            "flag" => $this->flag,
            "user" => new UserPreviewResource($this->user),
        ];
    }
}
