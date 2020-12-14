<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RegisterAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_admin', function (Blueprint $table) {
          $table->bigincrements('id');
          $table->string('name');
          $table->string('institute_id');
          $table->integer('role_id')->unsigned();
          $table->string('email');
          $table->string('phone_no');
          $table->string('address');
          $table->string('image');
          $table->tinyInteger('status')->default(0)->comment('0-inactive, 1-active');
          $table->rememberToken();
          $table->timestamp('deleted_at')->nullable();
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
       schema::dropIfExists('register_admin');
    }
}
