<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIssueDetail extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function stockIssue(){
        return $this->belongsTo(StockIssue::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }
}
