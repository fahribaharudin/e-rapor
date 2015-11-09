<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiPengetahuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_pengetahuan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('siswa_id')->unsigned();
            $table->integer('mapel_id')->unsigned();
            $table->integer('kompetensi_id')->unsigned();
            $table->string('semester', 2);
            $table->float('tertulis');
            $table->float('observasi');
            $table->float('penugasan');

            $table->foreign('siswa_id')
                ->references('id')
                ->on('siswa')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('mapel_id')
                ->references('id')
                ->on('mapel')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('kompetensi_id')
                ->references('id')
                ->on('kompetensi_dasar')
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
        Schema::drop('nilai_pengetahuan');
    }
}
