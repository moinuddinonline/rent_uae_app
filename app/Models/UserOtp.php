<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserOtp extends Model
{
    protected $table = 'user_otps';

    protected $fillable = [
        'type',
        'email',
        'mobile_prefix',
        'mobile',
        'code',
        'resend'
    ];
}
