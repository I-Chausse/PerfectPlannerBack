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
        Schema::create("tasks", function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name");
            $table->longtext("description")->nullable();
            $table->double("remaining_time")->nullable();
            $table->foreignId("project_id")->constrained();
            $table
                ->foreignId("domain_item_status_id")
                ->constrained("domain_items");
            $table
                ->foreignId("domain_item_flag_id")
                ->constrained("domain_items");
            $table->foreignId("user_id")->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("tasks");
    }
};
