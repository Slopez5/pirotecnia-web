<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'phone',
        'client_name',
        'client_address',
        'event_address',
        'event_date',
        'event_time',
        'event_type_id',
        'package_id',
        'discount',
        'deposit',
        'viatic',
        'notes',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($event) {
            $event->products()->detach();
            $event->employees()->detach();
            $event->packages()->detach();
        });
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(Package::class);
    }

    public function equipments(): BelongsToMany
    {
        return $this->belongsToMany(Equipment::class)->withPivot('quantity')->withTimestamps();
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class)->withTimestamps();
    }

    public function products() : MorphToMany {
        return $this->morphToMany(Product::class, 'productable')->withPivot('quantity', 'price')->withTimestamps();
    }

    public function typeEvent(): BelongsTo
    {
        return $this->belongsTo(EventType::class, 'event_type_id', 'id');
    }
    
}
