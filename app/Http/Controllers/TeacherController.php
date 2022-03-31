<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class TeacherController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'full_name'=>'required|min:3|max:30',                        
            'phone'=>'required|min:9|max:13|unique:teachers,phone'            ,
            'password'=>'required'
        ]);
        Teacher::create([
            'full_name'=>$request->full_name,                        
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password)
        ]);        
        return ResponseController::success();        
    }

    public function edit(Request $request,$id){        
        $request->validate([
            'full_name'=>'required|min:3|max:10',                        
            'phone'=>'required|min:9|max:13',
            'password'=>'required'
        ]);
        $true=Teacher::where('id',$id)->where('role','teacher')->update([
            'full_name'=>$request->full_name,            
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password)
        ]);
        if($true){
            return ResponseController::success();
        }
        return ResponseController::error(['message'=>$true->errors()]);
    }

    public function delete($id){
        Teacher::where('id',$id)->delete();
        return ResponseController::success();
    }
    public function view(){
        $all=Teacher::all();
        return ResponseController::data($all);
    }
}
