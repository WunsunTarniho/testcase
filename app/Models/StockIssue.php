<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIssue extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($stockIssue) {
            if (empty($stockIssue->status_id)) {
                $stockIssue->status_id = Status::first()->id;
            }

            if (empty($stockIssue->code)) {
                $stockIssue->code = rand(100000, 999999);
            }
        });
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function stockIssueDetails(){
        return $this->hasMany(StockIssueDetail::class);
    }

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }
}
