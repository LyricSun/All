<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students',function (Blueprint $table){

            $table->increments('id');
            $table->string('name',50)->default('');
            $table->string('age',50)->default('');
            $table->string('city',100)->default('');
            $table->string('phoneNumber',100)->default('');
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

    }
}
