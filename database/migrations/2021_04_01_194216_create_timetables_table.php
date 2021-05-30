<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->string('monday_start');
            $table->string('monday_end');
            $table->string('tuesday_start');
            $table->string('tuesday_end');
            $table->string('wednesday_start');
            $table->string('wednesday_end');
            $table->string('thursday_start');
            $table->string('thursday_end');
            $table->string('friday_start');
            $table->string('friday_end');
            $table->string('saturday_start');
            $table->string('saturday_end');
            $table->string('sunday_start');
            $table->string('sunday_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timetables');
    }
}
