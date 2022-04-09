<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function add(Request $request){
        $role  = $request->user()->role;
        if($role != "admin"){
            return ResponseController::error('No permission', 403);
        }   
        $validation = Validator::make($request->all(), [
            'subject'=>'required'
        ]);

        if($validation->fails()){
            return ResponseController::error($validation->errors()->first(), 422);            
        }
       
        Subject::create([
            'subject'=>$request->subject
        ]);
        return ResponseController::success();
    }
    public function edit(Request $request,$id){
        $role  = $request->user()->role;
        if($role != "admin"){
            return ResponseController::error('No permission', 403);
        }   
        $validation = Validator::make($request->all(), [
            'subject'=>'required'
        ]);

        if($validation->fails()){
            return ResponseController::error($validation->errors()->first(), 422);            
        }
        Subject::where('id',$id)->update([
            'subject'=>$request->subject
        ]);
        return ResponseController::success();
    }
    public function delete($id){
        $role  = Auth::user()->role;
        if($role != "admin"){
            return ResponseController::error('No permission', 403);
        }   
        Subject::where('id',$id)->delete();
        return ResponseController::success();
    }
    public function view(){        
        $subjects=Subject::select('subject')->get();
        return ResponseController::data($subjects);
    }
}
