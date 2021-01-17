<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->biginteger('phone_no')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->integer('pincode')->nullable();
            $table->integer('institute_id');
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->biginteger('id_proof')->nullable();
            $table->string('password');
            $table->tinyInteger('gender')->comment('1-male, 2-female, 3-other');
            $table->date('DOB')->nullable();
            $table->boolean('status')->default(1)->comment('0-inactive, 1-active');
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
        Schema::dropIfExists('students');
    }
}
