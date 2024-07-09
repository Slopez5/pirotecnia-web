<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Package extends Model
{
    use HasFactory;

    public function productGroups(): BelongsToMany
    {
        return $this->belongsToMany(ProductGroup::class,'product_group_package')->withPivot('quantity');
    }
    
}
