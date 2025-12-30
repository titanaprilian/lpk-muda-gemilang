<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table("registrant", function (Blueprint $table) {
            // We use string to store the file path (e.g., "uploads/ktp/image.jpg")
            // We make them nullable just in case you need to edit data later without re-uploading
            $table->string("scan_ktp")->nullable()->after("notes");
            $table->string("scan_kk")->nullable()->after("scan_ktp");
            $table->string("scan_akta")->nullable()->after("scan_kk");
            $table->string("scan_ijazah_sd")->nullable()->after("scan_akta");
            $table
                ->string("scan_ijazah_smp")
                ->nullable()
                ->after("scan_ijazah_sd");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table("registrant", function (Blueprint $table) {
            $table->dropColumn([
                "scan_ktp",
                "scan_kk",
                "scan_akta",
                "scan_ijazah_sd",
                "scan_ijazah_smp",
            ]);
        });
    }
};
