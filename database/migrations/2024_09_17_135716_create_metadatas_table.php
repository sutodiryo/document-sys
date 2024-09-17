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
        Schema::dropIfExists('file_metadatas');

        Schema::create('metadatas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignUuid('folder_id')
                ->nullable()
                ->references('id')
                ->on('folders')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignUuid('file_id')
                ->nullable()
                ->references('id')
                ->on('files')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('name');
            $table->text('description')
                ->nullable();

            $table->integer('allow_multiple_use')
                ->nullable();
            $table->string('data_type');

            $table->longText('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metadatas');
    }
};
