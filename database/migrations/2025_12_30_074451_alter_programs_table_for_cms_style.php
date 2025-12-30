<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table("program", function (Blueprint $table) {
            // 1. Drop the rigid columns
            $table->dropColumn([
                "duration",
                "schedule",
                "requirements",
                "capacity",
            ]);

            // 2. Add the dynamic columns
            // 'program_name' will serve as the Title
            $table->string("slug")->unique()->after("program_name")->nullable(); // For URL (e.g. /program/magang-jepang)
            $table->string("image")->nullable()->after("slug"); // Hero Image path
            $table->longText("content")->nullable()->after("description"); // The Full HTML Content (CKEditor/TinyMCE)

            // Note: We keep 'description' to serve as the "Little Description"
            // shown in the radio button selection.
        });
    }

    public function down(): void
    {
        Schema::table("program", function (Blueprint $table) {
            $table->dropColumn(["slug", "image", "content"]);
            $table->string("duration", 50)->nullable();
            $table->text("schedule")->nullable();
            $table->text("requirements")->nullable();
            $table->integer("capacity")->nullable();
        });
    }
};
