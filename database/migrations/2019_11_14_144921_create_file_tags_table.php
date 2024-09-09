<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_tags', function (Blueprint $table) {
            $table->foreignUuid('file_id')
                ->nullable()
                ->references('id')
                ->on('files')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignUuid('tag_id')
                ->nullable()
                ->references('id')
                ->on('tags')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_tags');
    }
};
