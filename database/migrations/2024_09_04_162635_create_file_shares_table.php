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
        Schema::create('file_shares', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('file_id')
                ->nullable()
                ->references('id')
                ->on('files')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('email')->nullable();
            $table->string('role')->nullable();
            $table->dateTime('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_shares');
    }
};
