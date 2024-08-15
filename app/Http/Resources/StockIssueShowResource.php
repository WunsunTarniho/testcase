<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockIssueShowResource extends JsonResource
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
            'company_id' => $this->company->id,
            'code' => $this->code,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
            'account_id' => $this->account->id,
            'status_id' => $this->status->id,
            'note' => $this->note,
        ];
    }
}
