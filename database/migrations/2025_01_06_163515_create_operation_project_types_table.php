<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('operation_project_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operation_id')->constrained('operations');
            $table->foreignId('type_id')->constrained('project_types');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('operation_project_types');
    }
};
