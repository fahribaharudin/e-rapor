<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKompentensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kompetensi_dasar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mapel_id')->unsigned();
            $table->string('nama_kompetensi');
            $table->string('semester', 2);

            $table->foreign('mapel_id')
                ->references('id')
                ->on('mapel')
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
        Schema::drop('kompetensi_dasar');
    }
}
