<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableSurat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_surat', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat', 50);
            $table->string('kategori', 50);
            $table->string('judul', 60);
            $table->timestamp('waktu_pengarsipan')->useCurrent();
            $table->string('file');
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
        Schema::dropIfExists('tb_surat');
    }
}
