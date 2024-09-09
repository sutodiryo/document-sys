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
            $table->string('approval_status')
                ->nullable()
                ->after('is_favorite');
            $table->longText('approval_resolution')
                ->nullable()
                ->after('approval_status');
        });

        Schema::create('folder_approvals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('folder_id')
                ->nullable()
                ->references('id')
                ->on('folders')
                ->cascadeOnUpdate()
                ->change();
            $table->string('email')->nullable();
            $table->string('file')->nullable();
            $table->longText('comment')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folders_approval');
    }
};
