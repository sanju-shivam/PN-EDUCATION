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
            $table->engine = 'InnoDB';
            $table->id();
            $table->integer('class_id')->unsigned();
            $table->integer('teacher_id')->unsigned();
            $table->integer('institute_id')->unsigned();
            $table->boolean('status')->default(1)->comment('0-inactive, 1-active')->nullable();
            $table->softDeletes();
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
