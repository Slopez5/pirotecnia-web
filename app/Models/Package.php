<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'duration',
        'description',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($package) {
            $package->products()->detach();
            $package->materials()->detach();
            $package->equipaments()->detach();
        });
    }

    public function materials(): MorphToMany {
        return $this->morphToMany(Product::class, 'productable')
        ->withPivot(['quantity','price'])
        ->withTimestamps()
        ->where(function($query){
            $query->where('product_role_id', 1)
            ->orWhere('product_role_id', 2);
        });
    }

    public function products(): MorphToMany
    {
        return $this->morphToMany(Product::class, 'productable')
        ->withPivot(['quantity','price'])
        ->withTimestamps()
        ->where('product_role_id', 1);
    }

    public function equipaments(): BelongsToMany
    {
        return $this->belongsToMany(Equipament::class)
        ->withPivot(['quantity'])
        ->withTimestamps();
    }

    public function events(): HasMany {
        return $this->hasMany(Event::class);
    }

    public function experienceLevel(): BelongsTo
    {
        return $this->belongsTo(ExperienceLevel::class, 'experience_level_id');
    }
    
}
