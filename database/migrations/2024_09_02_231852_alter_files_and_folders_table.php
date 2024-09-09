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
        Schema::table('folders', function (Blueprint $table) {
            $table->dateTime('active_until')
                ->nullable()
                ->after('is_favorite');
        });

        Schema::table('files', function (Blueprint $table) {
            $table->dateTime('active_until')
                ->nullable()
                ->after('verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('folders', function (Blueprint $table) {
            $table->dropColumn('active_until');
        });
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn('active_until');
        });
    }
};
