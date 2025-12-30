<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $table = "program";

    protected $fillable = [
        "program_name", // Title
        "slug", // URL friendly name
        "description", // Short summary for the Form Radio Button
        "content", // Full HTML body for the detail page
        "image", // Background/Hero Image
        "is_active",
    ];
}
