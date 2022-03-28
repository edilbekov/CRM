<?php

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});    
//Teacher
Route::post('/teacher/add',[TeacherController::class,'add']);
Route::post('/teacher/edit/{id}',[TeacherController::class,'edit']);
Route::get('/teacher/delete/{id}',[TeacherController::class,'delete']);

//Student
Route::post('/student/add',[StudentController::class,'add']);
Route::post('/student/edit/{id}',[StudentController::class,'edit']);
Route::get('/student/delete/{id}',[StudentController::class,'delete']);

//Group
Route::post('/group/add',[GroupController::class,'add']);
Route::post('/group/edit/{id}',[GroupController::class,'edit']);
Route::post('/group/delete/{id}',[GroupController::class,'delete']);

//Course
Route::post('/course/add',[CourseController::class,'add']);
Route::post('/course/edit/{id}',[CourseController::class,'edit']);
Route::post('/course/delete/{id}',[CourseController::class,'delete']);

//Schedule
Route::get('/schedule/view',[TeacherController::class,'schedule']);

    
// Route::prefix('/teacher')->controller(AdminController::class)->group(function(){
//     Route::post('/add','add');
//     Route::patch('/edit','edit');
//     Route::delete('/delete/{id}','delete');
// });
// Route::prefix('/student')->group(function(){
//     Route::post('/add',[StudentController::class, 'add']);
//     Route::patch('/edit','edit');
//     Route::delete('/delete/{id}','delete');
// });
