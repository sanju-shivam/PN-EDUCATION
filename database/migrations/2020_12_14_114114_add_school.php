<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSchool extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('add_school');
        Schema::create('add_school', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->bigincrements('id');
            $table->string('name');
            $table->string('logo')->nullable()->comment('image');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->integer('pin_code')->nullable();
            $table->biginteger('phone_no')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('affilation_no');
            $table->string('board_name');
            $table->tinyInteger('status')->default(1)->comment('0-inactive, 1-active')->nullable();
            $table->rememberToken();
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
           Schema::dropIfExists('add_school');
    }
}
