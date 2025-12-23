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
        Schema::create("testimonial", function (Blueprint $table) {
            $table->id(); // testimonial_id
            $table->string("alumni_name", 150)->notNull();
            $table->string("program_taken", 100)->nullable();
            $table->text("content")->notNull();
            $table->boolean("is_approved")->default(false);
            $table->integer("display_order")->nullable();
            $table->dateTime("created_at")->useCurrent(); // Explicit default timestamp
            // Note: We skip 'updated_at' here as testimonials are typically created and then approved.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("testimonial");
    }
};
