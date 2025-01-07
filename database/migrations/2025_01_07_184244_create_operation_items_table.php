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
        Schema::create('operation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operation_id')->constrained()->restrictOnDelete();
            $table->string('name');
            $table->string('unit');
            $table->integer('quantity');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('price_before');
            $table->string('price_after')->nullable();
            $table->longText('notes')->nullable();
            $table->integer('total_before')->nullable()->generatedAs('price_before * quantity')->storedAs('price_before * quantity');
            $table->integer('total_after')->nullable()->generatedAs('price_after * quantity')->storedAs('price_after * quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_items');
    }
};
