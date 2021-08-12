<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerkasKpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berkas_kp', function (Blueprint $table) {
            $table->increments("id_berkas_kp");
            $table->integer("id_pegawai");
            $table->foreign("id_pegawai")->references("id_pegawai")->on("pegawai")->onUpdate("cascade")->onDelete("cascade");
            $table->string("file");
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
        Schema::dropIfExists('berkas_kp');
    }
}
