<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryImage extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * We define this explicitly because the table is singular 'gallery_image'
     */
    protected $table = "gallery_image";

    /**
     * Disable standard timestamps (created_at, updated_at)
     * because your migration only has 'upload_date'
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "file_path",
        "title",
        "description",
        "is_public",
        "uploaded_by",
        "upload_date",
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        "is_public" => "boolean",
        "upload_date" => "datetime",
    ];

    /**
     * Relationship: The user who uploaded the image.
     */
    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, "uploaded_by");
    }

    /**
     * Helper to get full storage URL
     */
    public function getUrlAttribute(): string
    {
        return asset("storage/" . $this->file_path);
    }
}
