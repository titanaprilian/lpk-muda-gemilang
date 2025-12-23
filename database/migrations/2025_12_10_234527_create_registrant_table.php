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
        Schema::create("registrant", function (Blueprint $table) {
            $table->id();

            $table->string("registration_number", 20)->unique()->notNull();
            $table->foreignId("program_id")->constrained("program");
            $table->string("full_name", 150)->notNull();
            $table->string("birth_place", 100)->nullable();
            $table->date("date_of_birth")->nullable();
            $table->integer("age")->nullable();
            $table->string("gender", 10)->comment("Pria/Wanita")->nullable();
            $table->text("address")->nullable();
            $table->string("origin_school", 150)->nullable();
            $table
                ->string("phone_number", 20)
                ->comment("Phone/WhatsApp")
                ->nullable();
            $table->string("parent_guardian_phone", 20)->nullable();
            $table->string("email", 100)->nullable();
            $table->string("hobby", 100)->nullable();
            $table->integer("height_cm")->comment("Tinggi Badan")->nullable();
            $table->integer("weight_kg")->comment("Berat Badan")->nullable();
            $table
                ->text("work_experience")
                ->comment("Pengalaman Kerja")
                ->nullable();
            $table->dateTime("registration_date")->useCurrent();
            $table->string("status", 20)->default("Pending");
            $table->text("notes")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("registrant");
    }
};
