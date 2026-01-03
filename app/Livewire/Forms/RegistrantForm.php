<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Validate;
use App\Models\Registrant;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class RegistrantForm extends Form
{
    public ?Registrant $registrant = null;

    // --- 1. FORM PROPERTIES ---

    // Main Data
    public $program_id = "";
    public $full_name = "";
    public $gender = "Laki-laki";
    public $birth_place = "";
    public $date_of_birth = null;
    public $age = null;

    // Contact
    public $email = "";
    public $phone_number = "";
    public $parent_guardian_phone = "";
    public $address = "";

    // Additional Info
    public $origin_school = "";
    public $hobby = "";
    public $height_cm = "";
    public $weight_kg = "";
    public $work_experience = "";

    // Admin
    public $status = "Pending";
    public $notes = "";

    // Files (Initialize as null)
    public $scan_ktp = null;
    public $scan_kk = null;
    public $scan_akta = null;
    public $scan_ijazah_sd = null;
    public $scan_ijazah_smp = null;
    public $scan_ijazah_sma = null; // New field included

    // --- 2. VALIDATION RULES ---
    public function rules()
    {
        return [
            "program_id" => "required|exists:program,id",
            "full_name" => "required|min:3",
            "email" => "required|email",
            "phone_number" => "required|numeric",
            "gender" => "required|in:Laki-laki,Perempuan",
            "status" => "required",

            // Optional basic fields
            "birth_place" => "nullable|string",
            "date_of_birth" => "nullable|date",
            "age" => "nullable|numeric",
            "height_cm" => "nullable|numeric",
            "weight_kg" => "nullable|numeric",
            "address" => "nullable|string",
            "origin_school" => "nullable|string",
            "hobby" => "nullable|string",
            "work_experience" => "nullable|string",
            "notes" => "nullable|string",

            // File Validation
            "scan_ktp" => "nullable|file|mimes:jpg,jpeg,png,pdf|max:2048",
            "scan_kk" => "nullable|file|mimes:jpg,jpeg,png,pdf|max:2048",
            "scan_akta" => "nullable|file|mimes:jpg,jpeg,png,pdf|max:2048",
            "scan_ijazah_sd" => "nullable|file|mimes:jpg,jpeg,png,pdf|max:2048",
            "scan_ijazah_smp" =>
                "nullable|file|mimes:jpg,jpeg,png,pdf|max:2048",
            "scan_ijazah_sma" =>
                "nullable|file|mimes:jpg,jpeg,png,pdf|max:2048",
        ];
    }

    // --- 3. HELPER: LOAD DATA (For Edit Mode) ---
    public function setRegistrant(Registrant $registrant)
    {
        $this->registrant = $registrant;

        // Fill simple properties
        $this->fill($registrant->toArray());

        // Handle Date conversion for HTML input
        if ($registrant->date_of_birth) {
            $this->date_of_birth = $registrant->date_of_birth->format("Y-m-d");
        }

        // Reset file inputs to null (we don't load the file OBJECTS, only paths are in DB)
        $this->resetFiles();
    }

    // --- 4. MAIN ACTION: STORE ---
    public function store()
    {
        // A. Sanitize Files (Preserving your original logic)
        $this->sanitizeFileInputs();

        // B. Validate
        $this->validate();

        // C. Collect Data
        $data = $this->all();

        // D. Handle Uploads
        $uploadedPaths = $this->uploadFiles();

        // Merge uploaded paths into data (overwriting nulls)
        $data = array_merge($data, $uploadedPaths);

        // E. Save to Database
        if ($this->registrant) {
            $this->registrant->update($data);
        } else {
            $data["registration_date"] = now();
            Registrant::create($data);
        }
    }

    // --- 5. INTERNAL HELPERS ---

    protected function sanitizeFileInputs()
    {
        $fileFields = [
            "scan_ktp",
            "scan_kk",
            "scan_akta",
            "scan_ijazah_sd",
            "scan_ijazah_smp",
            "scan_ijazah_sma",
        ];

        foreach ($fileFields as $field) {
            // If the field is not a livewire file object, set it to null
            // This prevents validation errors on strings/existing paths
            if (!is_object($this->$field)) {
                $this->$field = null;
            }
        }
    }

    protected function uploadFiles()
    {
        $filePaths = [];
        $documentFields = [
            "scan_ktp",
            "scan_kk",
            "scan_akta",
            "scan_ijazah_sd",
            "scan_ijazah_smp",
            "scan_ijazah_sma",
        ];

        foreach ($documentFields as $field) {
            if ($this->$field && is_object($this->$field)) {
                // 1. Delete old file if exists
                if ($this->registrant && $this->registrant->$field) {
                    Storage::disk("public")->delete($this->registrant->$field);
                }

                // 2. Store new file
                $filePaths[$field] = $this->$field->store(
                    "registrants/documents",
                    "public",
                );
            }
        }

        return $filePaths;
    }

    protected function resetFiles()
    {
        $this->scan_ktp = null;
        $this->scan_kk = null;
        $this->scan_akta = null;
        $this->scan_ijazah_sd = null;
        $this->scan_ijazah_smp = null;
        $this->scan_ijazah_sma = null;
    }

    // Helper to calculate age (called from Component)
    public function calculateAge()
    {
        if ($this->date_of_birth) {
            $this->age = Carbon::parse($this->date_of_birth)->age;
        }
    }
}
