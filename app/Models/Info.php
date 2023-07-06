<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'work',
        'education',
        'address',
        'live',
        'phone',
        'gender',
        'birthday',
        'marital_status',
        'profile_image',
        'cover_image',
    ];
}
