<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationTeacher extends Model
{
    use HasFactory;
    protected $casts=[
        'exist'=>'boolean'
    ];
    public function group(){
        return $this->belongsTo(Group::class,'group_id');
    }
    public function employer(){
        return $this->belongsTo(Employer::class,'employer_id');
    }

}
