<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('topic', function (Blueprint $table) {
            $table->id();
            $table->enum('topic_type', ['Letter', 'File', 'Note', 'VIP Letter'])->nullable();
            $table->string('letter_no')->nullable();
            $table->string('rack_no')->nullable();
            $table->enum('received_by', ['By hand', 'Courier', 'Email'])->nullable();
            $table->string('by_hand_name')->nullable();
            $table->string('courier_name')->nullable();
            $table->string('tracking_id')->nullable();
            $table->string('email')->nullable();
            $table->enum('received_from', ['Internal', 'Public', "People\'s Representative"])->nullable();
            $table->string('received_from_name')->nullable();
            $table->foreignId('subject_id')->nullable()->constrained('subject')->cascadeOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('department')->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branch')->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->date('date')->nullable();
            $table->string('holder_name')->nullable();
            $table->enum('status', ['Received', 'In Process', 'Rejected', 'Signed'])->nullable();
            $table->string('concerned_officer')->nullable();
            $table->text('comment')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->cascadeOnDelete();
            $table->tinyInteger('is_deleted')->default(0)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('topic');
    }
};
