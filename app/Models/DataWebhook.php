<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataWebhook extends Model
{
    use HasFactory;
    protected $table = 'datawebhooks';

    protected $fillable = [
        'contact_name',
        'message',
        'direction',
        'hour',
        'message_type',
        'group_flag',
        'my_number',
        'scan_number',
        'quote_message',
        'quote_from',
        'quote_name',
        'sender_name',

    ];
}
