<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('uniqkey')->nullable()->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('photo')->default('public/images/blank.svg');
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->text('address')->nullable();
            $table->string('language')->default('en')->nullable();
            $table->string('verification_secret')->nullable();
            $table->longText('token')->nullable();
            $table->tinyInteger('is_online')->default(0)->comment('0 = offline, 1 = online, 2 = ideal')->nullable();
            $table->tinyInteger('is_deleted')->default(0)->nullable();
            $table->tinyInteger('is_enable')->default(1)->nullable();
            $table->timestamp('last_login')->nullable();
            $table->timestamp('current_login')->nullable();
            $table->timestamp('last_active_at')->nullable();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
