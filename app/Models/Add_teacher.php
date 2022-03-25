<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Add_teacher extends Model
{
    use HasFactory;
    protected $fillable=['name','surname','teacher','phone','password','active'];
}
