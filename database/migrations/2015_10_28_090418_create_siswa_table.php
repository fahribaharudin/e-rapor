<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('paket_id')->unsigned();
            $table->char('nis', 10);
            $table->char('nisn', 10);
            $table->string('nama');
            $table->string('tempat_lahir', 30);
            $table->date('tanggal_lahir');
            $table->char('jenis_kelamin', 1);
            $table->string('agama', 15);
            $table->string('status_dalam_kel', 30);
            $table->char('anak_ke', 1);
            $table->string('alamat_siswa');
            $table->string('sekolah_asal');
            $table->char('diterima_kelas', 1);
            $table->date('diterima_tanggal');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('alamat_ortu');
            $table->string('nama_wali')->nullable();
            $table->string('pekerjaan_wali', 30)->nullable();
            $table->string('alamat_wali')->nullable();
            $table->string('telepon_wali', 15)->nullable();
            $table->string('foto')->nullable();

            $table->foreign('paket_id')
                ->references('id')
                ->on('paket_keahlian')
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
        Schema::drop('siswa');
    }
}
