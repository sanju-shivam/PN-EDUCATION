<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIsClassTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('is_class_teacher', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id')->unsigned();
            $table->integer('teacher_id')->unsigned();
            $table->integer('institute_id')->unsigned();
            $table->boolean('status')->default(0)->comment('0-inactive, 1-active')->nullable();
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
        Schema::dropIfExists('is_class_teacher');
    }
}
