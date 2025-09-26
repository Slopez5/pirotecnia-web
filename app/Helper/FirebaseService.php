<?php

namespace App\Helper;

use GuzzleHttp\Client;

class FirebaseService
{
    protected $client;

    protected $accessToken;

    public function __construct()
    {
        $this->client = new Client;
        $this->accessToken = $this->getAccessToken();
    }

    protected function getAccessToken(): string
    {
        $jsonPath = storage_path('app/firebase/pirotecniasanrafael-11756-firebase-adminsdk-fbsvc-e81b8f8bcf.json');
        $credentials = json_decode(file_get_contents($jsonPath), true);

        $jwtHeader = ['alg' => 'RS256', 'typ' => 'JWT'];
        $now = time();
        $jwtClaimSet = [
            'iss' => $credentials['client_email'],
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
            'aud' => 'https://oauth2.googleapis.com/token',
            'iat' => $now,
            'exp' => $now + 3600,
        ];

        // Generar JWT y firmar con la clave privada
        $jwt = $this->generateJWT($jwtHeader, $jwtClaimSet, $credentials['private_key']);

        // Solicitar access token
        $response = $this->client->post('https://oauth2.googleapis.com/token', [
            'form_params' => [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $jwt,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        return $data['access_token'];
    }

    protected function generateJWT($header, $claims, $privateKey): string
    {
        $base64UrlEncode = fn ($data) => rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
        $headerEncoded = $base64UrlEncode(json_encode($header));
        $claimsEncoded = $base64UrlEncode(json_encode($claims));
        $signature = '';
        openssl_sign("$headerEncoded.$claimsEncoded", $signature, $privateKey, OPENSSL_ALGO_SHA256);

        return "$headerEncoded.$claimsEncoded.".$base64UrlEncode($signature);
    }

    public function sendMessage(string $token, array $notification, array $data = [], array $apns = [])
    {
        $body = [
            'message' => [
                'token' => $token,
                'notification' => array_map('strval', $notification),
                'data' => array_map('strval', $data),
            ],
        ];

        if (! empty($apns)) {
            $body['message']['apns'] = $apns;
        }
        $response = $this->client->post(
            'https://fcm.googleapis.com/v1/projects/'.env('FIREBASE_PROJECT_ID').'/messages:send',
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$this->accessToken,
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode($body),
            ]
        );

        return json_decode($response->getBody(), true);
    }
}
