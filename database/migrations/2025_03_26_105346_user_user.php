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
        Schema::create('user_users', function (Blueprint $table) {
            $table->timestamps();
            $table->foreignId('admin_user_id')->constrained('users');
            $table->foreignId('assignee_user_id')->constrained('users');
            $table->primary(['admin_user_id', 'assignee_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_user');
    }
};
