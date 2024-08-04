<?php

namespace App\Helper;

class CurlHelper {
    private $ch;

    // Constructor que inicializa la sesión cURL
    public function __construct() {
        $this->ch = curl_init();
    }

    // Destructor que cierra la sesión cURL
    public function __destruct() {
        curl_close($this->ch);
    }

    // Método para realizar una solicitud GET
    public static function get($url, $headers = [], $verifySsl = true) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $verifySsl);

        $response = curl_exec($ch);

        if(curl_errno($ch)) {
            $response = curl_error($ch);
        }

        curl_close($ch);
        return $response;
    }

    // Método para realizar una solicitud POST
    public static function post($url, $data = [], $headers = [], $verifySsl = true) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $verifySsl);

        $response = curl_exec($ch);

        if(curl_errno($ch)) {
            $response = curl_error($ch);
        }

        curl_close($ch);
        return $response;
    }
}