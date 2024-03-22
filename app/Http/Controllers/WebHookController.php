<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebHookController extends Controller
{
    public function set_incoming(Request $request)
    {
        $data = [
            "license" => env('WOOWA_LICENSE'), // "5c286f20169dd",
            "url" => env('WOOWA_URL_DOMAIN '), //"https://yourwebsite.com/listen.php", // message data will push to this url
            "no_wa" => env('WOOWA_NUMBER '), // "+628975835238", //sender number registered in woowa
            "action" => "set"
        ];

        $url = env('WOOWA_URL_WEBHOOK '); // "https://api.woo-wa.com/v2.0/webhook";

        try {
            $response = Http::post($url, $data);

            // Mendapatkan status code dari respons
            $statusCode = $response->status();
            // Mendapatkan isi dari respons
            $result = $response->body();
            dd($result, $statusCode);
            // Kembalikan respons HTTP
            return response($result, $statusCode);
        } catch (\Exception $e) {
            // Tangkap kesalahan jika terjadi
            return response("HTTP Error: " . $e->getMessage(), 500); // HTTP response with error status code
        }
    }
}
