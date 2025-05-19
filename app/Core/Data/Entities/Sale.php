<?php

namespace App\Core\Data\Entities;

class Sale
{
    public $id;

    public $client_id;

    public $client_name;

    public $client_email;

    public $client_phone;

    public $client_address;

    public $client_city;

    public $client_state;

    public $client_zip;

    public $client_country;

    public $client_rfc;

    public $client_type_id;

    public function __construct(array $attributes = [])
    {
        // Asigna los atributos dinámicamente
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public static function fromSale($sales)
    {
        return new Sale([
            'id' => $sales->id,
            'client_id' => $sales->client_id,
            'client_name' => $sales->client_name,
            'client_email' => $sales->client_email,
            'client_phone' => $sales->client_phone,
            'client_address' => $sales->client_address,
            'client_city' => $sales->client_city,
            'client_state' => $sales->client_state,
            'client_zip' => $sales->client_zip,
            'client_country' => $sales->client_country,
            'client_rfc' => $sales->client_rfc,
            'client_type_id' => $sales->client_type_id,
        ]);
    }
}
