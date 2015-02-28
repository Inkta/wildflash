<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotografiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('fotografies', function($table) {
            $table->increments('id');
            $table->string('path');
            $table->string('nom');
            $table->integer('user_id')->unsigned();
            $table->string('localitzacio');
            $table->integer('puntuacio')->default(0);
            $table->integer('faltes')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('fotografies');
    }

}
