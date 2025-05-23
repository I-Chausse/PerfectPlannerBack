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
        Schema::create("permission_roles", function (Blueprint $table) {
            $table->timestamps();
            $table->foreignId("permission_id")->constrained();
            $table->foreignId("role_id")->constrained();
            $table->primary(["permission_id", "role_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("permission_role");
    }
};
