<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('growth_comparisons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade');
            $table->string('month_year'); // e.g. "09-2026"
            $table->decimal('sales_last_year', 15, 2)->nullable();
            $table->decimal('sales_current_year', 15, 2)->nullable();
            $table->decimal('growth_percentage', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('growth_comparisons');
    }
};
