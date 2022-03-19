<?php

namespace App\Http\Controllers;

use App\Models\Add_teacher;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TeacherController extends Controller
{
   
    public function verification(Request $request){
        $verification=$request->verification;
        if($verification==1){
            
        }
        elseif($verification==0){

        }
        else{
            return "Error";
        }
        return back();
    }

    public function schedule(){
        $groups=Group::all();
        return $groups;
    }
}
