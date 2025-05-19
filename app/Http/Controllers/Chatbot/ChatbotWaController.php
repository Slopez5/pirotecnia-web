<?php

namespace App\Http\Controllers\Chatbot;

use App\Http\Controllers\Controller;

class ChatbotWaController extends Controller
{
    //
    public function webhook()
    {
        $token = 'pirotecnia_san_rafael';
        $hub_challenge = isset($_GET['hub_challenge']) ? $_GET['hub_challenge'] : '';
        $hub_verify_token = isset($_GET['hub_verify_token']) ? $_GET['hub_verify_token'] : '';
        if ($token === $hub_verify_token) {
            echo $hub_challenge;
            exit;
        }
    }

    public function recibe()
    {
        $respuesta = file_get_contents('php://input');
        if ($respuesta == null) {
            exit;
        }
        $respuesta = json_decode($respuesta);
    }
}
