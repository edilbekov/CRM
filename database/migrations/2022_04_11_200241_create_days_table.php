<?php

use App\Models\Day;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->timestamps();
        });
        Day::upsert([
            ['day'=>'Monday'],
            ['day'=>'Tuesday'],
            ['day'=> 'Wednesday'],
            ['day'=> 'Thursday'],
            ['day'=> 'Friday'],
            ['day'=> 'Saturday'],
            ['day'=> 'Sunday'],
        ], ['day']);        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('days');
    }
}
