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
        Schema::create("project_users", function (Blueprint $table) {
            $table->timestamps();
            $table->foreignId("user_id")->constrained();
            $table->foreignId("project_id")->constrained();
            $table->primary(["user_id", "project_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("project_user");
    }
};
