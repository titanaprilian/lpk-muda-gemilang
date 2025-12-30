<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrantRequest; // Import your new Request
use App\Models\Program;
use App\Models\Registrant;
use Illuminate\Support\Facades\Log;

class RegistrantController extends Controller
{
    public function create()
    {
        $programs = Program::where("is_active", true)->get();
        return view("public.form-pendaftaran", compact("programs"));
    }

    // Use StoreRegistrantRequest instead of standard Request
    public function store(StoreRegistrantRequest $request)
    {
        Log::info("Storing new registrant", $request->all());
        try {
            // 1. Upload Files
            $filePaths = $this->uploadDocuments($request);

            // 2. Map Data
            $registrantData = [
                "full_name" => $request->nama,
                "program_id" => $request->program_id,
                "birth_place" => $request->tempat_lahir,
                "birth_date" => $request->tanggal_lahir,
                "age" => $request->usia,
                "gender" => $request->jenis_kelamin,
                "address" => $request->alamat,
                "origin_school" => $request->asal_sekolah,
                "phone_number" => $request->telepon,
                "parent_guardian_phone" => $request->telepon_ortu,
                "email" => $request->email,
                "hobby" => $request->hobi,

                // New Split Logic
                "height_cm" => $request->tinggi_badan,
                "weight_kg" => $request->berat_badan,

                "work_experience" => $request->kerja,
                "status" => "pending",
                "registration_date" => now(),

                // Spread the file paths array
                ...$filePaths,
            ];

            Registrant::create($registrantData);

            return redirect()
                ->back()
                ->with("success", "Pendaftaran berhasil dikirim!");
        } catch (\Exception $e) {
            Log::error("Registration error: " . $e->getMessage());

            return redirect()
                ->back()
                ->with("error", "Terjadi kesalahan sistem. Silahkan coba lagi.")
                ->withInput();
        }
    }

    /**
     * Private helper to handle file uploads
     */
    private function uploadDocuments($request): array
    {
        $filePaths = [];
        $documents = [
            "scan_ktp",
            "scan_kk",
            "scan_akta",
            "scan_ijazah_sd",
            "scan_ijazah_smp",
        ];

        foreach ($documents as $docName) {
            if ($request->hasFile($docName)) {
                $filePaths[$docName] = $request
                    ->file($docName)
                    ->store("documents", "public");
            } else {
                $filePaths[$docName] = null;
            }
        }

        return $filePaths;
    }
}
