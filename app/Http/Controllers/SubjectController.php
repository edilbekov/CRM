<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'subject'=>'required'
        ]);
        Subject::create([
            'subject'=>$request->subject
        ]);
        return ResponseController::success();
    }
    public function edit(Request $request,$id){
        $request->validate([
            'subject'=>'required'
        ]);
        Subject::where('id',$id)->update([
            'subject'=>$request->subject
        ]);
        return ResponseController::success();
    }
    public function delete($id){
        Subject::where('id',$id)->delete();
        return ResponseController::success();
    }
}
