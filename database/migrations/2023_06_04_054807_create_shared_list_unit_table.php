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
        Schema::create('shared_list_unit', function (Blueprint $table) {
            $table->foreignId('shared_by')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('shared_with')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('list_unit_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shared_list_unit');
    }
};
