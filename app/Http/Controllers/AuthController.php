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

        $employers=Employer::where('phone',$phone)->first();
        if(!$employers or !Hash::check($password,$employers->password)){
            return abort(401);
        }
        $token=$employers->createToken('employers')->plainTextToken;
        return ResponseController::data(['token'=>$token]);
    }
}
