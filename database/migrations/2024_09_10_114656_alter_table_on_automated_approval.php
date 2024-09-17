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
        Schema::table('files', function (Blueprint $table) {
            $table->string('approval_folder')
                ->nullable()
                ->after('verified_by');
            $table->string('approval_status')
                ->nullable()
                ->after('approval_folder');
            $table->longText('approval_resolution')
                ->nullable()
                ->after('approval_status');
        });

        Schema::create('file_approvals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('file_id')
                ->nullable()
                ->references('id')
                ->on('files')
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
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn('approval_folder');
            $table->dropColumn('approval_status');
            $table->dropColumn('approval_resolution');
        });
        Schema::dropIfExists('file_approvals');
    }
};
