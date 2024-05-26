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
        Schema::create('uangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas');

            $table->decimal('uang', 10,3);
            $table->string('periode');
            $table->date('tanggal')->default(now());
            $table->string('caraBayar');
            $table->text('buktiBayar')->nullable();
            $table->string('status')->default('belum dibayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uangs');
    }
};
