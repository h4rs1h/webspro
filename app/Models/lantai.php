<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lantai extends Model
{
    use HasFactory;
    protected $table = 'lantai';

    protected $guarded = ['id'];
}
