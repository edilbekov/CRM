<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function add(Request $request){    
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
            'teacher_id'=>$request->teacher_id,
            'period_id'=>$request->period_id,
            'name'=>$request->name,            
            'days'=>$days,
            'start_date'=>$start_date,
            'end_date'=>$request->end_date            
        ]);           
        return ResponseController::success();        
    }
    public function edit(Request $request,$id){        
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
            'teacher_id'=>$request->teacher_id,
            'period_id'=>$request->period_id,
            'name'=>$request->name,            
            'days'=>$days,            
            'start_date'=>$start_date,
            'end_date'=>$request->end_date            
        ]);        
        return ResponseController::success();                
    }
    public function delete($id){
        Group::where('id',$id)->delete();
        return ResponseController::success();
    }
}
