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
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects');
            $table->date('operation_date')->nullable();
            $table->string('inbox_no')->nullable();
            $table->date('approval_date')->nullable();
            $table->string('timeframe')->nullable();
            $table->string('balancing_method')->nullable();
            $table->foreignId('type_id')->constrained('operation_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};
