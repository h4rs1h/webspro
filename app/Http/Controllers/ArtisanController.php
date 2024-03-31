<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
    public function runArtisanCommand()
    {
        // Jalankan perintah php artisan queue:work --queue=whatsappblast
        Artisan::call('queue:work', ['--queue' => 'whatsappblast']);

        // Berikan respons kepada pengguna
        return 'Perintah php artisan queue:work --queue=whatsappblast berhasil dijalankan.';
    }
}
