<?php

namespace App\Models;

use App\Models\Period;
use App\Models\Employer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;
    protected $fillable=['teacher_id','period_id','name','days','start_date','end_date'];
    protected $casts=[
        'days'=>'array'
    ];
    public function teacher(){
        return $this->belongsTo(Employer::class,'employer_id');
    }
    public function period(){
        return $this->belongsTo(Period::class,'period_id');
    }
}
