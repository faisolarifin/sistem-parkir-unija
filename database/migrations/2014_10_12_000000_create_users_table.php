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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('no_identitas', 20);
            $table->string('platnomor', 10);
            $table->timestamps();
        });
        Schema::create('accounts', function (Blueprint $table) {
            $table->id('id_akun');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('username');
            $table->string('password');
            $table->enum('role', ['user', 'admin', 'gate']);
            $table->enum('status', ['active', 'nonactive']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('users');
    }
};
