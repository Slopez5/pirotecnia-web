<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Package extends Model
{
    use HasFactory;

    public function productGroups(): MorphToMany
    {
        return $this->morphToMany(Product::class, 'productable')
        ->withPivot(['quantity','price'])
        ->withTimestamps()
        ->where('product_role_id',3);
    }

    public function materials(): MorphToMany {
        return $this->morphToMany(Product::class, 'productable')
        ->withPivot(['quantity','price'])
        ->withTimestamps()
        ->where('product_role_id',1)
        ->orWhere('product_role_id',2);
    }

    public function products(): MorphToMany
    {
        return $this->morphToMany(Product::class, 'productable')
        ->withPivot(['quantity','price'])
        ->withTimestamps()
        ->where('product_role_id',1);
    }

    public function equipaments(): BelongsToMany
    {
        return $this->belongsToMany(Equipament::class)->withPivot(['quantity'])->withTimestamps();
    }
    
}
