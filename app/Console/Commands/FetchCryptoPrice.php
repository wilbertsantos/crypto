<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use TechTailor\BinanceApi\BinanceAPI;
use Illuminate\Support\Carbon;
use Binance\API;
use GuzzleHttp\Client;

class FetchCryptoPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:crypto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    { 

    $binance = new BinanceAPI();
    $apiKey = env('BINANCE_KEY');
    $secretKey = env('BINANCE_SECRET');
    $binance->setApi($apiKey, $secretKey);

    
    $binance = new BinanceAPI();
    $api = new API($apiKey, $secretKey);

    $symbol = 'BTCUSDT';
    $price = '22386.9';
    $ops = 'above';
    if($binance->getAvgPrice($symbol)['price'] > $price){
        $message = 'Hey everyone, we have a meeting in 10 minutes! Please join us in the voice channel @here.';
        $webhookUrl = 'https://discord.com/api/webhooks/1082280005532389466/U_AzdzwC3urzb-N0SNi8ZCn29IZQS4tSxfS4f7mo3YlrLtxWVQx_2Gc7zR7JyjXv8P8g'; // replace with your webhook URL
        $client = new Client();
        $response = $client->post($webhookUrl, [
            'json' => [
                'content' => $message
            ]
        ]);
        return true;
    }

    }
}
