<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracking_mh', function (Blueprint $table) {
            $table->id();
            $table->string('no_toko')->nullable();
            $table->string('nama_toko');
            $table->string('corporate_level')->nullable();
            $table->string('tipe')->nullable();
            $table->integer('bulan')->default(9);
            $table->integer('tahun')->default(2026);
            // Kolom per tanggal 1-31
            for ($i = 1; $i <= 31; $i++) {
                $table->decimal("tgl_$i", 8, 2)->nullable();
            }
            $table->text('nota')->nullable();
            $table->timestamps();
        });

        Schema::create('tracking_sales', function (Blueprint $table) {
            $table->id();
            $table->string('no_toko')->nullable();
            $table->string('nama_toko');
            $table->string('area')->nullable();
            $table->integer('bulan')->default(9);
            $table->integer('tahun')->default(2026);
            $table->decimal('target_mtd', 15, 2)->nullable();
            $table->decimal('aktual_mtd', 15, 2)->nullable();
            for ($i = 1; $i <= 31; $i++) {
                $table->decimal("tgl_$i", 15, 2)->nullable();
            }
            $table->text('nota')->nullable();
            $table->timestamps();
        });

        Schema::create('tracking_suhu', function (Blueprint $table) {
            $table->id();
            $table->string('nama_toko');
            $table->string('nama_equipment');
            $table->enum('jenis', ['Chiller', 'Freezer', 'Ambience', 'Product']);
            $table->decimal('suhu_standar_min', 5, 1)->nullable();
            $table->decimal('suhu_standar_max', 5, 1)->nullable();
            $table->integer('bulan')->default(9);
            $table->integer('tahun')->default(2026);
            for ($i = 1; $i <= 31; $i++) {
                $table->decimal("tgl_$i", 5, 1)->nullable();
            }
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracking_mh');
        Schema::dropIfExists('tracking_sales');
        Schema::dropIfExists('tracking_suhu');
    }
};
