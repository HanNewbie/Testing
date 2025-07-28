<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submission', function (Blueprint $table) {
            $table->id();
            $table->string('vendor');
            $table->date('apply_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('name_event');
            $table->string('file')->nullable();
            $table->string('ktp');
            $table->string('appl_letter')->nullable();
            $table->string('actv_letter')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submission');
    }
};

