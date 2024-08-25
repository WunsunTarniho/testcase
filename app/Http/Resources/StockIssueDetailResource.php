<?php

namespace App\Http\Resources;

use App\Models\UnitItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockIssueDetailResource extends JsonResource
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
            'item_id' => $this->item->id,
            'item_code' => $this->item->code,
            'item_name' => $this->item->item_name,
            'quantity' => $this->quantity,
            'unit_name' => UnitItem::find($this->item->unit_id)->unit_name,
        ];
    }
}
