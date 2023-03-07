<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TechTailor\BinanceApi\BinanceAPI;
use Illuminate\Support\Carbon;
use Binance\API;
use GuzzleHttp\Client;

class BinanceController extends Controller
{
    //
    public function getUserInfo(){
        
    $binance = new BinanceAPI();
    $apiKey = env('BINANCE_KEY');
    $secretKey = env('BINANCE_SECRET');
    $binance->setApi($apiKey, $secretKey);

    
    $binance = new BinanceAPI();
    $api = new API($apiKey, $secretKey);


    if($binance->getAvgPrice('BTCUSDT')['price'] > '22386.9'){
        self::sendDiscordMessage('Hey everyone, we have a meeting in 10 minutes! Please join us in the voice channel @here.');
        return true;
    }

    }

    
    public static function sendDiscordMessage($message)
    {
        $webhookUrl = 'https://discord.com/api/webhooks/1082280005532389466/U_AzdzwC3urzb-N0SNi8ZCn29IZQS4tSxfS4f7mo3YlrLtxWVQx_2Gc7zR7JyjXv8P8g'; // replace with your webhook URL
        $client = new Client();
        $response = $client->post($webhookUrl, [
            'json' => [
                'content' => $message
            ]
        ]);
        return $response->getStatusCode(); // returns 204 on success
    }

    
}
