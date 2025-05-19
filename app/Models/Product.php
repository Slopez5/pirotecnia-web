<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_role_id',
        'name',
        'description',
        'unit',
        'duration',
        'shots',
        'caliber',
        'shape',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            $product->products()->detach();
        });
    }

    public function products(): MorphToMany
    {
        return $this->morphToMany(Product::class, 'productable')
            ->withPivot('quantity', 'price')
            ->withTimestamps()
            ->where('product_role_id', 1);
    }

    public function productParents(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'productable');
    }

    public function events(): MorphToMany
    {
        return $this->morphedByMany(Event::class, 'productable');
    }

    public function inventories(): MorphToMany
    {
        return $this->morphedByMany(Inventory::class, 'productable')->withPivot(['quantity', 'price']);
    }

    public function packages(): MorphToMany
    {
        return $this->morphedByMany(Package::class, 'productable');
    }
}
