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
            $table->bigincrements('id');
            $table->string('name');
            $table->string('logo')->comment('image');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->integer('pin_code');
            $table->biginteger('phone_no');
            $table->string('email');
            $table->string('affilation_no');
            $table->integer('role_id');
            $table->string('board_name');
            $table->tinyInteger('status')->default(0)->comment('0-inactive, 1-active')->nullable();
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
