<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Personal
            "nama" => "required|string|max:255",
            "program_id" => "required|integer|exists:program,id",
            "jenis_kelamin" => "required|string|in:Laki-laki,Perempuan",
            "tempat_lahir" => "required|string|max:255",
            "tanggal_lahir" => "required|date",
            "usia" => "required|integer",
            "tinggi_badan" => "required|numeric|min:100|max:250",
            "berat_badan" => "required|numeric|min:30|max:200",
            "hobi" => "required|string",
            "alamat" => "required|string",

            // Contact & Background
            "email" => "required|email|max:255",
            "telepon" => "required|string|max:20",
            "telepon_ortu" => "required|string|max:20",
            "asal_sekolah" => "required|string",
            "kerja" => "nullable|string",
            "tujuan" => "nullable|array",

            // Files (2MB Max)
            "scan_ktp" => "required|file|mimes:pdf,jpg,jpeg,png|max:2048",
            "scan_kk" => "required|file|mimes:pdf,jpg,jpeg,png|max:2048",
            "scan_akta" => "required|file|mimes:pdf,jpg,jpeg,png|max:2048",
            "scan_ijazah_sd" => "required|file|mimes:pdf,jpg,jpeg,png|max:2048",
            "scan_ijazah_smp" =>
                "required|file|mimes:pdf,jpg,jpeg,png|max:2048",
        ];
    }

    public function attributes(): array
    {
        return [
            "program_id" => "Program Choice",
        ];
    }
}
