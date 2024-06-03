<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RereModel extends Model
{
    use HasFactory;
    protected $table = 'rere_news';

    protected $fillable = [
        'fin_month', 'fin_year', 'title', 'tgl_pesan', 'jam_pesan', 'isi_pesan', 'mintower', 'maxtower', 'minlantai', 'maxlantai'
    ];
}
