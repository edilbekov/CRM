<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function add(Request $request){
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
        Subject::where('id',$id)->delete();
        return ResponseController::success();
    }
    public function view(){
        $subjects=Subject::select('name')->get();
        return ResponseController::data($subjects);
    }
}
