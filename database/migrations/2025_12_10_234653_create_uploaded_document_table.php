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
        Schema::create("uploaded_document", function (Blueprint $table) {
            $table->id();
            $table->foreignId("registrant_id")->constrained("registrant");
            $table
                ->string("document_type", 50)
                ->notNull()
                ->comment("e.g., KTP, Ijazah, Photo");
            $table
                ->string("file_path", 255)
                ->notNull()
                ->comment("Path to stored file in Laravel storage");
            $table->string("file_mime_type", 50)->nullable();
            $table->dateTime("upload_date")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("uploaded_document");
    }
};
