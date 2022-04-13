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
        $role  = $request->user()->role;
        if($role != "teacher"){
            return ResponseController::error('No permission', 403);
        }   
        $verification=$request->exist;
        $group_id=$request->group_id;
        $student_id=$request->student_id;
        
        Verification::create([
            'group_id'=>$group_id,
            'student_id'=>$student_id,
            'date'=>$request->date,
            'exist'=>$verification
        ]);        
        return ResponseController::success();
    }
    public function teacher(Request $request){
        $role  = $request->user()->role;
        if($role != "admin"){
            return ResponseController::error('No permission', 403);
        }
        $verification=$request->exist;
        $group_id=$request->group_id;
        $teacher_id=$request->teacher_id;                
        VerificationTeacher::create([
            'group_id'=>$group_id,
            'employer_id'=>$teacher_id,
            'date'=>$request->date,
            'exist'=>$verification
        ]);        
        return ResponseController::success();
    }
    public function student_history(){
        $all=Verification::select('group_id','student_id','date','exist')->get();
        $final=[];
        foreach($all as $item){
            $final[]=[
                'group'=>[
                    'id'=>$item->group->id,
                    'name'=>$item->group->name
                ],
                'student'=>[
                    'id'=>$item->student->id,
                    'name'=>$item->student->full_name
                ],
                'date'=>$item->date,
                'exist'=>$item->exist
            ];
        }
        return ResponseController::data($final);
    }
    public function teacher_history(){
        $all=VerificationTeacher::select('group_id','employer_id','date','exist')->get();
        $final=[];
        foreach($all as $item){
            $final[]=[
                'group'=>[
                    'id'=>$item->group->id,
                    'name'=>$item->group->name
                ],
                'employer'=>[
                    'id'=>$item->employer->id,
                    'name'=>$item->employer->full_name
                ],
                'date'=>$item->date,
                'exist'=>$item->exist
            ];
        }
        return ResponseController::data($final);
    }
}
