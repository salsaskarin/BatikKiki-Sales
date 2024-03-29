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
        Schema::create('dailysells', function (Blueprint $table) {
            $table->id();
            $table->string('type', 50);
            $table->date('date');
            $table->bigInteger('pemasukan');
            $table->bigInteger('pengeluaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dailysells');
    }
};
