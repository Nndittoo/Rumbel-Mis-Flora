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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajar_id')->constrained('pengajars');

            $table->decimal('gaji', 10,3);
            $table->date('tanggal')->default(now());
            $table->string('caraBayar');
            $table->text('buktiBayar')->nullable();
            $table->string('periode');
            $table->string('status')->default('belum dibayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
