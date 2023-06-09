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
            $table->unsignedBigInteger('id_akun');
            $table->foreign('id_akun')->references('id_akun')->on('accounts')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('nama_gate')->comment('nama fakultas');
            $table->integer('jml_max');
            $table->string('denah', 255)->nullable();
            $table->timestamps();
        });
        Schema::create('parkir_gate_spaces', function (Blueprint $table) {
            $table->id('id_gatespace');
            $table->unsignedBigInteger('id_gate')->nullable();
            $table->foreign('id_gate')->references('id_gate')->on('parkir_gates')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('kode_space')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id_user')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
        Schema::create('parkir_trans', function (Blueprint $table) {
            $table->id('id_trans');
            $table->unsignedBigInteger('id_gate');
            $table->foreign('id_gate')->references('id_gate')->on('parkir_gates')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('id_gatespace');
            $table->foreign('id_gatespace')->references('id_gatespace')->on('parkir_gate_spaces')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->dateTime('tgl_masuk')->nullable();
            $table->dateTime('tgl_keluar')->nullable();
            $table->integer('lama_parkir')->nullable()->comment('satuan menit');
            $table->string('kode_masuk')->nullable();
            $table->string('kode_keluar')->nullable();
            $table->string('status', 20)->nullable();
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
