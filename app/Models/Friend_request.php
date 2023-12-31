<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend_request extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'request_id',
        'action',
    ];
}
