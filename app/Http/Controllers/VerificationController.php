<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Verification;
use Illuminate\Http\Request;
use App\Http\Controllers\ResponseController;
use App\Models\Course;
use App\Models\VerificationTeacher;
use Illuminate\Support\Facades\Validator;

class VerificationController extends Controller
{
    public function student(Request $request){
        // $role  = $request->user()->role;
        // if($role != "teacher"){
        //     return ResponseController::error('No permission', 403);
        // }   
        $verification=$request->exist;
        $group_id=$request->group_id;
        $student_id=$request->student_id;        
        $validation=Validator::make($request->all(),[
            'group_id'=>'exists:groups,id',
            'student_id'=>'exists:students,id'
        ]);                        
        if($validation->fails()){
            return ResponseController::error($validation->errors()->first(),422);
        }
        $id=Course::select('student_id')->where('group_id',$group_id)->first();        
        if($id->student_id!=$student_id){
            return ResponseController::error('No student on the group',422);
        }        
        $validation=Validator::make($request->all(),[
            'student_id'=>'unique:verifications,student_id'
        ]);        
        if($validation->errors()->first()=="The student id has already been taken."){
            Verification::where('group_id',$group_id)->update([
                'group_id'=>$group_id,
                'student_id'=>$student_id,
                'date'=>$request->date,
                'exist'=>$verification
            ]);
            return ResponseController::success();
        }
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
    public function student_history($id){
        $all=Verification::select('group_id','student_id','date','exist')->where('group_id',$id)->get();
        $final=[];        
        foreach($all as $item){
            $final[]=[
                'group'=>[
                    'id'=>$item->group->id ?? null,
                    'name'=>$item->group->name ?? null
                ],
                'student'=>[
                    'id'=>$item->student->id ?? null,
                    'name'=>$item->student->full_name ?? null
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
