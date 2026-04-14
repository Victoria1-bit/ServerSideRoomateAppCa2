<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('chores', function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_to')->nullable()->after('title');
            $table->unsignedBigInteger('assigned_by')->nullable()->after('assigned_to');
            $table->string('status')->default('pending')->after('assigned_by');
        });
    }

    public function down(): void
    {
        Schema::table('chores', function (Blueprint $table) {
            $table->dropColumn(['assigned_to', 'assigned_by', 'status']);
        });
    }
};