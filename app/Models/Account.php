<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function stockIssues(){
        $this->hasMany(StockIssue::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
