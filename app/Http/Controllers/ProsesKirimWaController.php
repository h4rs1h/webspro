<?php

namespace App\Http\Controllers;

use App\Models\Outbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProsesKirimWaController extends Controller
{

    function kirimsp()
    {
        $url = env('WOOWA_URL_SEND') . 'send_message';
        $keys = env('WOOWA_KEY');

        $data = Outbox::where('tglsending', null)
            ->wherein('tipe', ['SP1', 'SP2', 'SP3', 'INV'])
            ->orderbyraw('id')
            ->first();
        // dd($data);
        if ($data !== null) {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->withOptions([
                'debug' => false,
                'connect_timeout' => false,
                'timeout' => false,
                'verify' => false,
            ])->post($url, [
                'phone_no' => $data->wa,
                'message' => $data->pesan,
                'key' => $keys,
                // 'skip_link' => true, // Optional untuk skip snapshot link dalam pesan
                // 'flag_retry'   => 'on', // Optional untuk retry saat gagal mengirim pesan
                // 'pendingTime'  => 3 // Optional untuk delay sebelum mengirim pesan
            ]);

            // dd($response->body());

            // if ($response->body() == 'success') {
            $upd = ([
                'tglsending' => now(),
                'status' => $response->body()
            ]);
            Outbox::where('id', $data->id)
                ->update($upd);

            return redirect(url('send-message'))->with('status', 'success');
        } else {
            return;
            //     return redirect(url('send-message'))->with('status', 'warning');
        }
    }

    function runScript()
    {
        return view('Admin.run-proses-outbox');
    }
    function run_Script()
    {
        return view('Admin.run-proses-outbox');
    }
}
