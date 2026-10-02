<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracking_sheets', function (Blueprint $table) {
            $table->id();
            $table->string('sheet_name');
            $table->string('no_toko')->nullable();
            $table->string('nama_toko');
            $table->string('corporate_level')->nullable();
            $table->string('tipe')->nullable();
            $table->integer('bulan')->default(9);
            $table->integer('tahun')->default(2026);
            for ($i = 1; $i <= 31; $i++) {
                $table->decimal("tgl_$i", 8, 2)->nullable();
            }
            $table->text('nota')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracking_sheets');
    }
};
