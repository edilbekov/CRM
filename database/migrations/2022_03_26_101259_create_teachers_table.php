<?php

use App\Models\Teacher;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');                        
            $table->string('phone');
            $table->string('password');
            $table->enum('role',['teacher','admin']);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
        Teacher::create([
            'full_name'=>'Azizbek Edilbekov',
            'phone'=>'+998907362044',
            'password'=>Hash::make('hello'),
            'role'=>'Admin'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
