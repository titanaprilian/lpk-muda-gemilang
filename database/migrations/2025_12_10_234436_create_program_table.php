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
        Schema::create("program", function (Blueprint $table) {
            $table->id();
            $table
                ->string("program_name", 100)
                ->unique()
                ->comment("Nama Program")
                ->notNull();
            $table->text("description")->nullable();
            $table->string("duration", 50)->nullable();
            $table->text("schedule")->nullable();
            $table->text("requirements")->nullable();
            $table->integer("capacity")->nullable();
            $table->boolean("is_active")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("program");
    }
};
