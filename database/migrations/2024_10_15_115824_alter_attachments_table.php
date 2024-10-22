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
        Schema::table('attachments', function (Blueprint $table) {
            $table->string('file_type')
            ->nullable()
            ->after('file');
            $table->float('file_size')
            ->nullable()
            ->after('file_type');
            $table->string('path')
            ->nullable()
            ->after('file_size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attachments', function (Blueprint $table) {
            $table->dropColumn('file_type');
            $table->dropColumn('file_size');
            $table->dropColumn('path');
        });
    }
};
