<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function items(){
        return $this->hasMany(Item::class);
    }

    public function stockIssues(){
        return $this->hasMany(StockIssue::class);
    }

    public function accounts(){
        return $this->hasMany(Account::class);
    }

    public function accountGroups(){
        return $this->hasMany(AccountGroup::class);
    }

    public function itemGroups(){
        return $this->hasMany(ItemGroup::class);
    }
}
