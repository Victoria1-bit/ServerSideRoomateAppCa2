<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            if (!Schema::hasColumn('expenses', 'title')) {
                $table->string('title')->nullable();
            }

            if (!Schema::hasColumn('expenses', 'category')) {
                $table->string('category')->nullable();
            }

            if (!Schema::hasColumn('expenses', 'amount')) {
                $table->decimal('amount', 8, 2)->nullable();
            }

            if (!Schema::hasColumn('expenses', 'payment_status')) {
                $table->string('payment_status')->default('pending');
            }

            if (!Schema::hasColumn('expenses', 'description')) {
                $table->text('description')->nullable();
            }

            if (!Schema::hasColumn('expenses', 'split_type')) {
                $table->string('split_type')->nullable();
            }

            if (!Schema::hasColumn('expenses', 'selected_users')) {
                $table->text('selected_users')->nullable();
            }

            if (!Schema::hasColumn('expenses', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable();
            }
        });
    }

    public function down(): void
    {
        // Leave down() empty to avoid accidental data loss in SQLite
    }
};