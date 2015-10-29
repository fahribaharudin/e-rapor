<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaketKeahlianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket_keahlian', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('program_id')->unsigned();
            $table->integer('bidang_id')->unsigned();
            $table->string('nama');

            $table->foreign('program_id')
                ->references('id')
                ->on('program_keahlian')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::drop('paket_keahlian');
    }
}
