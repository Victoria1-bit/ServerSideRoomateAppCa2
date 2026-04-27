<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('chores', function (Blueprint $table) {
            if (!Schema::hasColumn('chores', 'photo_description')) {
                $table->text('photo_description')->nullable()->after('due_date');
            }
        });
    }

    public function down(): void
    {
        Schema::table('chores', function (Blueprint $table) {
            if (Schema::hasColumn('chores', 'photo_description')) {
                $table->dropColumn('photo_description');
            }
        });
    }
};