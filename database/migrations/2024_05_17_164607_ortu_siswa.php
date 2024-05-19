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
        Schema::create('ortu_siswa', function (Blueprint $table){
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas');
            $table->foreignId('ortu_id')->constrained('ortus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ortu_siswa');
    }
};
