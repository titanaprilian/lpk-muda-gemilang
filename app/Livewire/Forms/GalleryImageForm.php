<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Validate;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class GalleryImageForm extends Form
{
    public ?GalleryImage $galleryImage = null;

    // --- Properties ---
    public $title = "";
    public $description = "";
    public $is_public = true;

    // Temporary file upload property
    public $image = null;

    // --- Validation Rules ---
    public function rules()
    {
        // Image is mandatory for Create, but optional for Update
        $imageRule = $this->galleryImage ? "nullable" : "required";

        return [
            "title" => "nullable|string|max:150",
            "description" => "nullable|string",
            "is_public" => "boolean",
            "image" => [
                $imageRule,
                "image",
                "max:2048", // 2MB Max
                "mimes:jpg,jpeg,png,webp",
            ],
        ];
    }

    // --- Load Data (For Edit) ---
    public function setGalleryImage(GalleryImage $galleryImage)
    {
        $this->galleryImage = $galleryImage;

        $this->title = $galleryImage->title;
        $this->description = $galleryImage->description;
        $this->is_public = $galleryImage->is_public ? 1 : 0;

        // We do not fill $this->image here. It stays null until the user uploads a new one.
    }

    // --- Save Logic (Create & Update) ---
    public function store()
    {
        $this->validate();

        // 1. Prepare Basic Data
        $data = [
            "title" => $this->title,
            "description" => $this->description,
            "is_public" => $this->is_public,
        ];

        // 2. Handle File Upload
        if ($this->image) {
            // A. If editing, delete the old file first to keep storage clean
            if ($this->galleryImage && $this->galleryImage->file_path) {
                Storage::disk("public")->delete($this->galleryImage->file_path);
            }

            // B. Store the new file
            $data["file_path"] = $this->image->store("gallery", "public");
        }

        // 3. Execute DB Action
        if ($this->galleryImage) {
            // --- UPDATE ---
            $this->galleryImage->update($data);
        } else {
            // --- CREATE ---
            $data["uploaded_by"] = Auth::id();
            $data["upload_date"] = now();

            GalleryImage::create($data);
        }

        // 4. Reset Form
        $this->reset();
    }
}
