<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table("registrant", function (Blueprint $table) {
            $table
                ->string("scan_ijazah_sma")
                ->nullable()
                ->after("scan_ijazah_smp");
        });
    }

    public function down()
    {
        Schema::table("registrant", function (Blueprint $table) {
            $table->dropColumn("scan_ijazah_sma");
        });
    }
};
