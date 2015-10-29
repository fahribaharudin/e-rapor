<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramKeahlianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_keahlian', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bidang_id')->unsigned();
            $table->string('nama');

            $table->foreign('bidang_id')
                ->references('id')
                ->on('bidang_keahlian')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('program_keahlian');
    }
}
