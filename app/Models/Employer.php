<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Employer extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;
    protected $casts=[
        'active'=>'boolean',
    ];
    protected $hidden=[
        'password'
    ];
}
