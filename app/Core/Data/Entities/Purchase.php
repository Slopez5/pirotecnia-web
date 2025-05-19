<?php

namespace App\Core\Data\Entities;

class Purchase
{
    public $id;

    public $user_id;

    public $date;

    public function __construct(array $attributes = [])
    {
        // Asigna los atributos dinámicamente
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public static function fromPurchase($purchase)
    {
        return new Purchase([
            'id' => $purchase->id,
            'user_id' => $purchase->user_id,
            'date' => $purchase->date,
        ]);
    }
}
