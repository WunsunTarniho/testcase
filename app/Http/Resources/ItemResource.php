<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'item_name' => $this->item_name,
            'company_name' => $this->company->company_name,
            'code' => $this->code,
            'item_group' => $this->itemGroup->group_name,
            'unit_name' => $this->unitItem->unit_name,
            'is_active' => $this->is_active,
        ];
    }
}
