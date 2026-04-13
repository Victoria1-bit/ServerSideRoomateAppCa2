<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            if (!Schema::hasColumn('expenses', 'category')) {
                $table->string('category')->default('Shared Items')->after('title');
            }

            if (!Schema::hasColumn('expenses', 'split_type')) {
                $table->string('split_type')->default('all')->after('description');
            }

            if (!Schema::hasColumn('expenses', 'selected_users')) {
                $table->json('selected_users')->nullable()->after('split_type');
            }
        });
    }

    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            if (Schema::hasColumn('expenses', 'selected_users')) {
                $table->dropColumn('selected_users');
            }

            if (Schema::hasColumn('expenses', 'split_type')) {
                $table->dropColumn('split_type');
            }

            if (Schema::hasColumn('expenses', 'category')) {
                $table->dropColumn('category');
            }
        });
    }
};
