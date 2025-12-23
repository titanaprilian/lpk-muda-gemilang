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
        Schema::create("gallery_image", function (Blueprint $table) {
            $table->id();
            $table
                ->string("file_path", 255)
                ->notNull()
                ->comment("Path to the stored image");
            $table->string("title", 150)->nullable();
            $table->text("description")->nullable();
            $table
                ->boolean("is_public")
                ->default(true)
                ->comment("Display Control");
            $table
                ->foreignIdFor(\App\Models\User::class, "uploaded_by")
                ->nullable()
                ->constrained("users");
            $table->dateTime("upload_date")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("gallery_image");
    }
};
