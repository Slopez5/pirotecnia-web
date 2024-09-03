<?php

namespace App\Helper;

class Whatsapp
{
    private $bearerToken;
    private $baseUrl;
    private $phoneId;
    private $to;
    private $type;
    private $payload;

    /**
     * Create a new class instance.
     */
    public function __construct($to, $type)
    {
        $this->bearerToken = config('services.whatsapp.bearer_token');
        $this->baseUrl = config('services.whatsapp.base_url')  . '/' . config('services.whatsapp.version') . '/' . config('services.whatsapp.phone_id') . '/messages';
        $this->phoneId = config('services.whatsapp.phone_id');
        $this->to = $to;
        $this->type = $type;
        $this->payload = [];
    }

    /**
     * Destroy the class instance.
     */
    public function __destruct()
    {
        //
    }

    /**
     * Build Text Message
     */
    public static function textMessage($phoneTo)
    {
        $whatsapp = new Whatsapp($phoneTo, 'text');
        return $whatsapp;
    }

    /**
     * Build Template Message
     * @param $phoneTo required
     * @param $components required
     * @return $this
     */
    public static function templateMessage($phoneTo)
    {
        $whatsapp = new Self($phoneTo, 'template');
        return $whatsapp;
    }

    /**
     * set name Template
     * @param $name required
     * @return $this
     */
    public function setName($name) {
        $this->payload["name"] = $name;
        return $this;
    }

    /**
     * set add component Template
     * @param $type required
     * @param $subType required when type is button
     * @param $index required when type is button
     * @param $parameters required when type is button
     * @return $this
     */

    public function addComponent(WhatsappComponent $component) {
        $component = $component->getComponent();
        $this->payload["components"][] = $component;
        return $this;
    }


    /**
     * set language Template
     * @param $language required
     * @return $this
     */
    public function setLanguage($language) {
        $this->payload["language"] = [
            "code" => $language
        ];
        return $this;
    }



    /**
     * Send Whatsapp
     */
    public function send()
    {
        
        if (!$this->payload) {
            return;
        }
        //Send Whatsapp
        $payload = [
            "messaging_product" => "whatsapp",
            "to" => $this->to,
            "type" => $this->type,
        ];
        $payload[$this->type] = $this->payload;
        $data = $payload;
        logger($data);
        $response = CurlHelper::post($this->baseUrl, $data, [
            "Authorization: Bearer $this->bearerToken",
            "Content-Type: application/json"
        ], false);

        return $response;
    }
}
