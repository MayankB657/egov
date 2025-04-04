<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('letter_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('letter_id')->nullable()->constrained('letter')->cascadeOnDelete();
            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
            $table->tinyInteger('is_deleted')->default(0)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('letter_files');
    }
};
