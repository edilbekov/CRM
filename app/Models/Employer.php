<?php

namespace App\Models;

use App\Models\Group;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


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
