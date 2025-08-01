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
        Schema::create('content_features', function (Blueprint $table) {
        $table->id();
        $table->foreignId('location')->constrained('content')->cascadeOnDelete();
        $table->enum('type', ['price','facility'])->index();
        $table->string('bagian')->nullable();
        $table->string('luas')->nullable();
        $table->unsignedBigInteger('price')->nullable();
        $table->string('facility_name')->nullable();
        $table->string('icon')->nullable();
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricelists');
    }
};
