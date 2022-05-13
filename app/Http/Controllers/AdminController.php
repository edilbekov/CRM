<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function add(Request $request){        
        $role  = $request->user()->role;
        if($role != "admin"){
            return ResponseController::error('No permission', 403);
        }        
        $validation = Validator::make($request->all(), [
            'full_name'=>'required|min:3|max:30',                        
            'phone'=>'required|min:9|max:13|unique:employers,phone',
            'password'=>'required'
        ]);

        if($validation->fails()){
            return ResponseController::error($validation->errors()->first(), 422);            
        }        
        Employer::create([
            'full_name'=>$request->full_name,                        
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),
            'role'=>'admin'
        ]);        
        $all=Employer::select('full_name','phone','password')->where('phone',$request->phone)->first();
        return ResponseController::data($all);
    }
    public function edit(Request $request,$id){
        $role  = $request->user()->role;
        if($role != "admin"){
            return ResponseController::error('No permission', 403);
        }
        
        $validation = Validator::make($request->all(), [
            'full_name'=>'required|min:3|max:30',                        
            'phone'=>'required|min:9|max:13|unique:employers,phone',
            'password'=>'required'
        ]);

        if($validation->fails()){
            return ResponseController::error($validation->errors()->first(), 422);            
        }

        $employer=Employer::where('id',$id)->where('role','admin')->firstOrFail();
        $employer->update([
            'full_name'=>$request->full_name,            
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),
            'role'=>'admin'
        ]);        
        $all=Employer::select('full_name','phone','password')->where('phone',$request->phone)->first();
        return ResponseController::data($all);
    }
    public function delete($id){
        $role  = Auth::user()->role;
        if($role != "admin"){
            return ResponseController::error('No permission', 403);
        }   
        Employer::where('id',$id)->delete();
        return ResponseController::success();
    }
    public function view(){
        $all=Employer::select('full_name','phone','active')->where('role','admin')->get();
        return ResponseController::data($all);
    }
}
