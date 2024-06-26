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
        Schema::create('nilai_siswa_materi', function (Blueprint $table){
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas');
            $table->foreignId('materi_id')->constrained('materis');
            $table->foreignId('nilai_id')->constrained('nilais');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_siswa_materi');
    }
};
