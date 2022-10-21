<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('contests', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('creater_id');
        $table->string('con_name');
        $table->integer('con_time')->default('0');
        $table->date('date')->nullable();
        $table->time('from')->nullable();
        $table->time('to')->nullable();
        $table->integer('status')->default('0');
        $table->string('con_id');
        $table->string('con_password');
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
        //
    }
}
