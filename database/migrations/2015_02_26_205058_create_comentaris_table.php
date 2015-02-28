<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentarisTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('comentaris', function($table) {
            $table->increments('id');
            $table->string('comentari')->default('');
            $table->integer('puntuacio')->default(0);
            $table->integer('user_id')->unsigned();
            $table->integer('fotografia_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('comentaris');
    }

}
