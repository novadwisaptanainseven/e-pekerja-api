<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiBerhentiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai_berhenti', function (Blueprint $table) {
            $table->increments("id_pegawai_berhenti");
            $table->integer("id_pegawai");
            $table->foreign("id_pegawai")->references("id_pegawai")->on("pegawai")->onUpdate("cascade")->onDelete("cascade");
            $table->date("tgl_berhenti");
            $table->string("keterangan");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai_berhenti');
    }
}
