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
        Schema::table("program", function (Blueprint $table) {
            // Short text for Radio Buttons (e.g. "Internship Jepang")
            $table->string("subtitle")->nullable()->after("program_name");

            // Bootstrap Icon class (e.g. "bi-bounding-box-circles")
            $table->string("icon")->default("bi-collection")->after("image");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("programs", function (Blueprint $table) {
            $table->dropColumn(["subtitle", "icon"]);
        });
    }
};
