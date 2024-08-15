<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemGroup extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function items(){
        return $this->hasMany(Item::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
