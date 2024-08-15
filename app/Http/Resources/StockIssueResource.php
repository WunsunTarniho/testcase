<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockIssueResource extends JsonResource
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
            'company_name' => $this->company->company_name,
            'code' => $this->code,
            'created_at' => Carbon::parse($this->created_at)->format('j F Y'),
            'account_name' => $this->account->account_name,
            'status' => $this->status->status_name,
        ];
    }
}
