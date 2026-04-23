<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClientType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'percentage_price',
        'price_list_id',
    ];

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class, 'client_type_id');
    }
}
