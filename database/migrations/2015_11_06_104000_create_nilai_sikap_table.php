<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiSikapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_sikap', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('siswa_id')->unsigned();
            $table->integer('mapel_id')->unsigned();
            $table->integer('kompetensi_id')->unsigned();
            $table->string('semester', 2);
            $table->float('observasi');
            $table->float('penilaian_diri');
            $table->float('penilaian_sebaya');
            $table->float('jurnal');

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
        Schema::drop('nilai_sikap');
    }
}
