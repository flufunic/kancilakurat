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
        Schema::create('rencanas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_seksi');
            $table->bigInteger('saldo_tahunan');
            $table->bigInteger('minggu_1')->default(0);
            $table->bigInteger('minggu_2')->default(0);
            $table->bigInteger('minggu_3')->default(0);
            $table->bigInteger('minggu_4')->default(0);
            $table->bigInteger('sisa_saldo_bulan')->default(0);
            $table->string('bulan'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencanas');
    }
};
