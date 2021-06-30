<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKenaikanPangkatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kenaikan_pangkat', function (Blueprint $table) {
            $table->id();
            $table->integer("id_pegawai");
            $table->foreign("id_pegawai")->references("id_pegawai")->on('pegawai')->onUpdate("cascade")->onDelete("cascade");
            $table->string("pangkat_baru", 60);
            $table->date("tmt_kenaikan_pangkat");
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
        Schema::dropIfExists('kenaikan_pangkat');
    }
}
