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
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->string('car_id')->foreignId('car_id')->constrained();
            $table->string('user_id')->foreignId('user_id')->constrained();
            $table->string('pj_satu')->foreignId('user_id')->constrained();
            $table->string('pj_dua')->foreignId('user_id')->constrained();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('status')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
