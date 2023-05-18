<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parkir_gates', function (Blueprint $table) {
            $table->id('id_gate');
            $table->string('nama_gate')->comment('nama fakultas');
            $table->integer('jml_max');
            $table->timestamps();
        });
        Schema::create('parkir_gate_spaces', function (Blueprint $table) {
            $table->id('id_gatespace');
            $table->unsignedBigInteger('id_gate');
            $table->foreign('id_gate')->references('id_gate')->on('parkir_gates')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('kode_space');
        });
        Schema::create('parkir_trans', function (Blueprint $table) {
            $table->id('id_trans');
            $table->unsignedBigInteger('id_gate');
            $table->foreign('id_gate')->references('id_gate')->on('parkir_gates')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('id_gatespace');
            $table->foreign('id_gatespace')->references('id_gatespace')->on('parkir_gate_spaces')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->dateTime('tgl_masuk');
            $table->dateTime('tgl_keluar');
            $table->integer('lama_parkir')->nullable()->comment('satuan menit');
            $table->string('kode_keluar')->nullable();
            $table->string('status', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkir_trans');
        Schema::dropIfExists('parkir_gate_spaces');
        Schema::dropIfExists('parkir_gates');
    }
};
