<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_teacher', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name');
            $table->integer('phone_no');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->integer('pincode');
            $table->integer('institute_id');
            $table->integer('email');
            $table->integer('id_proof')->nullable();
            $table->string('password');
            $table->boolean('status')->default(0)->comment('0-inactive, 1-active');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('updated_by')->nullable();
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
        Schema::dropIfExists('add_teacher');
    }
}
