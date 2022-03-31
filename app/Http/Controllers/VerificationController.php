<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Verification;
use Illuminate\Http\Request;
use App\Http\Controllers\ResponseController;
use App\Models\VerificationTeacher;

class VerificationController extends Controller
{
    public function student(Request $request){
        $verification=$request->verification;
        $student_id=$request->student_id;
        $group_id=Group::select('id')->where('student_id',$student_id)->first();
        if($verification==true){
            Verification::create([
                'group_id'=>$group_id,
                'student_id'=>$student_id,
                'exist'=>true
            ]);
        }
        elseif($verification==false){
            Verification::create([
                'group_id'=>$group_id,
                'student_id'=>$student_id,
                'exist'=>false
            ]);
        }
        return ResponseController::success();
    }
    public function teacher(Request $request){
        $verification=$request->verification;
        $teacher_id=$request->teacher_id;
        $group_id=Group::select('id')->where('teacher_id',$teacher_id)->first();
        if($verification==true){
            VerificationTeacher::create([
                'group_id'=>$group_id,
                'teacher_id'=>$teacher_id,
                'exist'=>true
            ]);
        }
        elseif($verification==false){
            VerificationTeacher::create([
                'group_id'=>$group_id,
                'teacher_id'=>$teacher_id,
                'exist'=>false
            ]);
        }
        return ResponseController::success();
    }
}
