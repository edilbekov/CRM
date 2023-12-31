<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Group;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function add(Request $request){  
        $role  = $request->user()->role;
        if($role != "admin"){
            return ResponseController::error('No permission', 403);
        }                   
        $validation = Validator::make($request->all(), [
            'teacher_id'=>'required',
            'period_id'=>'required',
            'name'=>'required',            
            'days'=>'required',            
            'start_date'=>'required',
            'end_date'=>'required'
        ]);

        if($validation->fails()){
            return ResponseController::error($validation->errors()->first(), 422);            
        }    
        
        $daysofweek=$request->days;                
        $date=$request->start_date;        
        $start_year=$date['year'];
        $start_month=$date['month'];
        $start_day=$date['day'];
        $start_date=$start_year.".".$start_month.".".$start_day;        
        $carbon = Carbon::create($start_year, $start_month, $start_day);                        
        
        $end_date=$request->end_date;                        
        $all_days=[];
        while($carbon->format('Y.m.d')!=$end_date){            
            if(in_array($carbon->dayOfWeek,$request->days)){
                $all_days[]=$carbon->format('Y.m.d');
            }
            $carbon->addDays();
        }    
        $days=json_encode($all_days);            
        Group::create([
            'employer_id'=>$request->teacher_id,
            'period_id'=>$request->period_id,
            'name'=>$request->name,            
            'days'=>$days,
            'start_date'=>$start_date,
            'end_date'=>$request->end_date,
            'daysofweek'=>json_encode($daysofweek)     
        ]);           
        return ResponseController::success();        
    }
    public function edit(Request $request,$id){   
        $role  = $request->user()->role;
        if($role != "admin"){
            return ResponseController::error('No permission', 403);
        }     
        $validation = Validator::make($request->all(), [
            'employer_id'=>'required',
            'period_id'=>'required',
            'name'=>'required',            
            'days'=>'required',            
            'start_date'=>'required',
            'end_date'=>'required'
        ]);

        if($validation->fails()){
            return ResponseController::error($validation->errors()->first(), 422);            
        }  
        $daysofweek=$request->days;    
        $date=$request->start_date;        
        $start_year=$date['year'];
        $start_month=$date['month'];
        $start_day=$date['day'];
        $start_date=$start_year.".".$start_month.".".$start_day;        
        $carbon = Carbon::create($start_year, $start_month, $start_day);                        
        
        $end_date=$request->end_date;                        
        $all_days=[];
        while($carbon->format('Y.m.d')!=$end_date){            
            if(in_array($carbon->dayOfWeek,$request->days)){
                $all_days[]=$carbon->format('Y.m.d');
            }
            $carbon->addDays();            
        }    
        $days=json_encode($all_days);
        $true=Group::where('id',$id)->update([
            'employer_id'=>$request->teacher_id,
            'period_id'=>$request->period_id,
            'name'=>$request->name,            
            'days'=>$days,            
            'start_date'=>$start_date,
            'end_date'=>$request->end_date,
            'daysofweek'=>$daysofweek
        ]);        
        return ResponseController::success();                
    }
    public function delete($id){
        $role  = Auth::user()->role;
        if($role != "admin"){
            return ResponseController::error('No permission', 403);
        }
        Group::where('id',$id)->delete();
        return ResponseController::success();
    }
    public function view(){                
        $groups=Group::select('employer_id','period_id','name','days','start_date','end_date','daysofweek')->get();
        $final=[];        
        foreach($groups as $group){
            $final[]=[
                'name'=>$group->name,
                'teacher'=>[
                    'id'=>$group->teacher->id ?? null,
                    'name'=>$group->teacher->full_name ?? null
                ],
                'period'=>[
                    'id'=>$group->period->id ?? null,
                    'period'=>$group->period->period ?? null,
                    'start_time'=>$group->period->start_time ?? null,
                    'finish_time'=>$group->period->finish_time ?? null
                ],
                'days'=>$group->days,
                'daysofweek'=>$group->daysofweek,
                'start_date'=>$group->start_date,
                'end_date'=>$group->end_date
            ];
        }
        return ResponseController::data($final);
    }
    public function students(Request $request, $group_id){
        $student_ids=Course::select('student_id')->where('group_id',$group_id)->get();
        $students=[];        
        foreach($student_ids as $id){   
            $id=$id->student_id;                     
            $students[]=Student::select('full_name','phone')->where('id',$id)->first();            
        }
        return ResponseController::data($students);
    }
}
