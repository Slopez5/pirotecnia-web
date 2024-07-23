<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Inventory extends Model
{
     const MAX_STOCK = 1000;
     const MIN_STOCK = 10;
    use HasFactory;

    public function products() : MorphToMany {
        return $this->morphToMany(Product::class,'productable')->withPivot(['quantity','price'])->withTimestamps();
    }
}
