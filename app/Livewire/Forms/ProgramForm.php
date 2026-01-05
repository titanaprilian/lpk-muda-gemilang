<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Program;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProgramForm extends Form
{
    public ?Program $program = null;

    // Properties
    public $program_name = "";
    public $slug = "";
    public $description = "";
    public $content = "";
    public $is_active = true;

    // File Upload
    public $image = null;
    public $existingImage = null;

    // Rules
    public function rules()
    {
        // Unique slug check, ignoring current ID if editing
        $slugUnique = "unique:program,slug";
        if ($this->program) {
            $slugUnique .= "," . $this->program->id;
        }

        return [
            "program_name" => "required|min:3",
            "slug" => "required|$slugUnique",
            "description" => "required|max:255", // Summary
            "content" => "required", // Full HTML
            "is_active" => "boolean",
            "image" => [
                $this->program ? "nullable" : "required", // Required on create
                "image",
                "max:2048", // 2MB
            ],
        ];
    }

    public function setProgram(Program $program)
    {
        $this->program = $program;
        $this->program_name = $program->program_name;
        $this->slug = $program->slug;
        $this->description = $program->description;
        $this->content = $program->content;
        $this->is_active = (bool) $program->is_active;

        $this->existingImage = $program->image;
    }

    // Auto-generate slug from title
    public function generateSlug()
    {
        $this->slug = Str::slug($this->program_name);
    }

    public function store()
    {
        $this->validate();

        $data = [
            "program_name" => $this->program_name,
            "slug" => $this->slug,
            "description" => $this->description,
            "content" => $this->content,
            "is_active" => $this->is_active,
        ];

        // Handle Image Upload
        if ($this->image) {
            // Delete old image if exists
            if ($this->program && $this->program->image) {
                Storage::disk("public")->delete($this->program->image);
            }
            $data["image"] = $this->image->store("programs", "public");
        }

        if ($this->program) {
            $this->program->update($data);
        } else {
            Program::create($data);
        }

        $this->reset();
    }
}
