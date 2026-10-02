<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tcmh_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade');
            $table->date('date');
            $table->string('store_type'); // e.g., 'Mall', 'Ruko DI', 'HBK', 'FSU', 'Ruko DI B'
            $table->decimal('target_tcmh', 8, 2);
            $table->decimal('actual_tcmh', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tcmh_records');
    }
};
