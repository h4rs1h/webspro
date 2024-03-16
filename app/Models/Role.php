<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'lavel'
    ];

    public function User()
    {
        return $this->belongsTo(user::class, 'role_id');
    }
}
