<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'house_id')) {
                $table->foreignId('house_id')->nullable()->after('profile_photo')->constrained('houses')->nullOnDelete();
            }
        });

        Schema::table('chores', function (Blueprint $table) {
            if (!Schema::hasColumn('chores', 'house_id')) {
                $table->foreignId('house_id')->nullable()->after('id')->constrained('houses')->cascadeOnDelete();
            }
        });

        Schema::table('expenses', function (Blueprint $table) {
            if (!Schema::hasColumn('expenses', 'house_id')) {
                $table->foreignId('house_id')->nullable()->after('id')->constrained('houses')->cascadeOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            if (Schema::hasColumn('expenses', 'house_id')) {
                $table->dropConstrainedForeignId('house_id');
            }
        });

        Schema::table('chores', function (Blueprint $table) {
            if (Schema::hasColumn('chores', 'house_id')) {
                $table->dropConstrainedForeignId('house_id');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'house_id')) {
                $table->dropConstrainedForeignId('house_id');
            }
        });
    }
};
