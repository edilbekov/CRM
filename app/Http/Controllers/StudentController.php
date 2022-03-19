<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class StudentController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'name'=>'required|min:3|max:10',
            'surname'=>'required|min:5|max:15',            
            'phone'=>'required|min:9|max:13'
        ]);
        $password=md5('teacher_');

        Student::create([
            'name'=>$request->name,
            'surname'=>$request->surname,            
            'phone'=>$request->phone,
            'password'=>$password
        ]);

        return "success";
    }
    public function edit(Request $request){             
        $request->validate([
            'name'=>'required|min:3|max:10',
            'surname'=>'required|min:5|max:15',            
            'phone'=>'required|min:9|max:13'
        ]);
        Student::where('id',1)->update([
            'name'=>$request->name,
            'surname'=>$request->surname,
            'phone'=>$request->phone            
        ]);
        return back();
    }

}
