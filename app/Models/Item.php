<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory, HasUuids;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            if (empty($item->code)) {
                $item->code = rand(100000, 999999);
            }
        });
    }

    protected $guarded = ['id'];

    public function itemGroup()
    {
        return $this->belongsTo(ItemGroup::class);
    }

    public function stockIssueDetails(){
        return $this->hasMany(StockIssueDetail::class);
    }

    public function unitItem(){
        return $this->belongsTo(UnitItem::class, 'unit_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
