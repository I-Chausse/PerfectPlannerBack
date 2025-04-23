<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("invitation_tokens", function (Blueprint $table) {
            $table->id();
            $table->string("token")->unique();
            $table->foreignId("user_id")->nullable()->constrained();
            $table
                ->foreignId("creator_user_id")
                ->nullable()
                ->constrained("users", "id");
            $table->foreignId("role_id")->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("invitation_tokens");
    }
};
