<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapel', function (Blueprint $table) {
            $table->increments('id');
            $table->string('child_type');
            $table->integer('child_id')->unsigned();
            $table->integer('paket_id')->unsigned();
            $table->char('kelompok', 2);
            $table->string('semester', 20);

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
        Schema::drop('mapel');
    }
}
