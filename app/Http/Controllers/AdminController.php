<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Course;
use App\Models\Add_teacher;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'name'=>'required|min:3|max:10',
            'surname'=>'required|min:5|max:15',
            'teacher'=>'required',
            'phone'=>'required|min:9|max:13'
        ]);
        $password=md5('teacher_');

        Add_teacher::create([
            'name'=>$request->name,
            'surname'=>$request->surname,
            'teacher'=>$request->teacher,
            'phone'=>$request->phone,
            'password'=>$password
        ]);

        return "success";
    }
    public function edit(Request $request){        
        $request->validate([
            'name'=>'required|min:3|max:10',
            'surname'=>'required|min:5|max:15',    
            'teacher'=>'required',        
            'phone'=>'required|min:9|max:13'
        ]);
        Add_teacher::where('id',1)->update([
            'name'=>$request->name,
            'surname'=>$request->surname,
            'teacher'=>$request->teacher,
            'phone'=>$request->phone            
        ]);
        return back();
    }
    public function delete($id){
        Add_teacher::where('id',$id)->delete();
        return back();
    }
    public function add_group(Request $request){                
        $request->validate([
            'name'=>'required',
            'teacher_id'=>'required',
            'days'=>'required',
            'hour'=>'required',
            'start_time'=>'required',
            'end_time'=>'required'
        ]);
        Group::create([
            'name'=>$request->name,
            'teacher_id'=>$request->teacher_id,
            'days'=>$request->days,
            'hour'=>$request->hour,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time            
        ]);
        return back();
    }

    public function add_course(Request $request){
        $request->validate([
            'group_id'=>'required',
            'student_id'=>'required',
            'price'=>'required'
        ]);
        Course::create([
            'group_id'=>$request->group_id,
            'student_id'=>$request->student_id,
            'price'=>$request->price
        ]);
        return response("success",200);
    }
}
