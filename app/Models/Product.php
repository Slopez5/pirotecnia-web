<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Product extends Model
{
    use HasFactory;

    public function products() : MorphToMany
    {
        return $this->morphToMany(Product::class, 'productable')
        ->withPivot('quantity', 'price')
        ->withTimestamps()
        ->where('product_role_id', 1);
    }

}
