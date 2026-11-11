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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            // Relationships
            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->restrictOnDelete();

            $table->foreignId('status_id')
                ->constrained('report_statuses')
                ->restrictOnDelete();

            $table->foreignId('assigned_department_id')
                ->nullable()
                ->constrained('departments')
                ->restrictOnDelete();

            $table->foreignId('assigned_officer_id')
                ->nullable()
                ->constrained('users')
                ->restrictOnDelete();

            // Report information
            $table->string('title', 150);
            $table->text('description');

            // Geographic coordinates
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);

            $table->string('address')->nullable();

            $table->timestamps();

            // Indexes
            $table->index(['status_id', 'created_at']);
            $table->index(['category_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};