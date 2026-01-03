<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrant extends Model
{
    use HasFactory;

    protected $table = "registrant";

    public $timestamps = false;

    protected $fillable = [
        "program_id",
        "full_name",
        "birth_place",
        "date_of_birth",
        "age",
        "gender",
        "address",
        "origin_school",
        "phone_number",
        "parent_guardian_phone",
        "email",
        "hobby",
        "height_cm",
        "weight_kg",
        "work_experience",
        "registration_date",
        "status",
        "notes",
        // New Document Fields
        "scan_ktp",
        "scan_kk",
        "scan_akta",
        "scan_ijazah_sd",
        "scan_ijazah_smp",
        "scan_ijazah_sma",
    ];

    protected $casts = [
        "date_of_birth" => "date",
        "registration_date" => "datetime",
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, "program_id");
    }
}
