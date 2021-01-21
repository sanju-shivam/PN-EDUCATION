<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeTableSchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_time_table_school', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('class_id');
            $table->integer('day_id');
            $table->bigInteger('teacher_id');
            $table->bigInteger(' subject_id');
            $table->integer('section_id')->nullable();
            $table->bigInteger('institute_id');
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
        Schema::dropIfExists('_time_table_school');
    }
}
