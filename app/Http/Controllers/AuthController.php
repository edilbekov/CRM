<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $phone=$request->phone;
        $password=$request->password;

        $employer=Employer::where('phone',$phone)->first();        
        if(!$employer or !Hash::check($password,$employer->password)){
            return abort(401);
        }        
        $token=$employer->createToken('employer')->plainTextToken;        
        return ResponseController::data(['role'=>$employer->role,'token'=>$token]);
    }
}
