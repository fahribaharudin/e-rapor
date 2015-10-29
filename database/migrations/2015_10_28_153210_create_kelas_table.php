<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('paket_id')->unsigned();
            $table->integer('guru_id')->unsigned();
            $table->string('nama_kelas', 20);
            $table->char('tingkat_kelas', 2);

            $table->foreign('paket_id')
                ->references('id')
                ->on('kelas')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('guru_id')
                ->references('id')
                ->on('guru')
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
        Schema::drop('kelas');
    }
}
