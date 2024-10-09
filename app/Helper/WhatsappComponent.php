<?php

namespace App\Helper;

class WhatsappComponent
{
    private $type;
    private $subType;
    private $index;
    private $parameters;
    /**
     * Create a new class instance.
     */
    public function __construct($type)
    {
        //
        $this->type = $type;
    }

    /**
     * Destroy the class instance.
     */
    public function __destruct()
    {
        //
        
    }

    /**
     * Build Button Component
     * @return $this
     */
    public static function buttonComponent() {
        $whatsappComponent = new Self("button");
        return $whatsappComponent;
    }

    /**
     * Build Body Component
     * @return $this
     */
    public static function bodyComponent() {
        $whatsappComponent = new Self("body");
        return $whatsappComponent;
    }

    /**
     * set SubType
     * @param $subType required
     * @return $this
     */
    public function setSubType($subType) {
        $this->subType = $subType;
        return $this;
    }

    /**
     * set Index
     * @param $index required
     * @return $this
     */
    public function setIndex($index) {
        $this->index = $index;
        return $this;
    }

    /**
     * add Parameter
     * @param $type required
     * @param $text required
     * @param $payload optional
     * @return $this
     */
    public function addParameter($type, $text, $payload = null) {
        $parameter = [
            "type" => $type,
        ];
        if ($text) {
            $parameter["text"] = $this->cleanText($text);
        }
        if ($payload) {
            $parameter["payload"] = $payload;
        }
        $this->parameters[] = $parameter;
        return $this;
    }

    private function cleanText($text) {
        return preg_replace(['/[\t\n]/', '/\s{2,}/'], [' ', ' '], $text);
    }

    /**
     * get Component
     * @return $this
     */
    public function getComponent() {
        $component = [
            "type" => $this->type,
        ];
        if ($this->subType != null) {
            $component["sub_type"] = $this->subType;
        }
        if ($this->index != null) {
            $component["index"] = $this->index;
        }
        if ($this->parameters) {
            $component["parameters"] = $this->parameters;
        }
        return $component;
    }

}
