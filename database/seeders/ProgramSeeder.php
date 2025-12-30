<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                "program_name" => "Program Magang",
                "slug" => "program-magang",
                "subtitle" => "Internship Jepang (Jisshusei)",
                "description" =>
                    "Menyediakan kesempatan bagi peserta untuk mendapatkan pengalaman kerja langsung di perusahaan Jepang.",
                "image" => "assets/img/programs/magang.jpg",
                "icon" => "bi-bounding-box-circles",
                "is_active" => true,
                "content" => '
                    <h3>Program Pemagangan ke Jepang</h3>
                    <p>Program ini bertujuan untuk meningkatkan keterampilan teknis peserta melalui praktik kerja langsung di Jepang selama 3 tahun.</p>
                    
                    <h4>Fasilitas:</h4>
                    <ul>
                        <li>Asrama di Jepang</li>
                        <li>Asuransi Kesehatan</li>
                        <li>Gaji standar Jepang</li>
                    </ul>

                    <h4>Persyaratan:</h4>
                    <ul>
                        <li>Usia 18-26 Tahun</li>
                        <li>Minimal lulusan SMA/SMK Sederajat</li>
                        <li>Sehat Jasmani dan Rohani</li>
                        <li>Tidak buta warna</li>
                    </ul>
                ',
            ],
            [
                "program_name" => "Tokutei Ginou",
                "slug" => "tokutei-ginou",
                "subtitle" => "Specified Skilled Worker",
                "description" =>
                    "Membantu peserta yang telah memiliki pengalaman dan kemampuan kerja agar dapat bekerja di Jepang secara legal.",
                "image" => "assets/img/programs/tokutei.jpg",
                "is_active" => true,
                "content" => '
                    <h3>Program Tokutei Ginou (SSW)</h3>
                    <p>Visa kerja khusus bagi tenaga kerja asing yang memiliki keahlian spesifik di bidang tertentu. Program ini memungkinkan Anda bekerja hingga 5 tahun di Jepang.</p>
                    
                    <h4>Bidang Pekerjaan:</h4>
                    <ul>
                        <li>Caregiver (Perawat Lansia)</li>
                        <li>Pertanian</li>
                        <li>Konstruksi</li>
                        <li>Pengolahan Makanan</li>
                    </ul>

                    <h4>Persyaratan:</h4>
                    <ul>
                        <li>Usia 18-35 Tahun</li>
                        <li>Memiliki sertifikat bahasa Jepang (JLPT N4 / JFT Basic A2)</li>
                        <li>Memiliki sertifikat skill (SSW) sesuai bidang</li>
                    </ul>
                ',
            ],
            [
                "program_name" => "IM Japan",
                "slug" => "im-japan",
                "subtitle" => "Independent Member of Japan",
                "description" =>
                    "Memberikan kesempatan bagi peserta untuk bekerja dan tinggal di Jepang secara mandiri dengan dukungan dari LPK.",
                "icon" => "bi-calendar4-week",
                "image" => "assets/img/programs/tokutei.jpg",
                "is_active" => true,
                "content" => '
                    <h3>Program IM Japan</h3>
                    <p>Memberikan kesempatan bagi peserta untuk bekerja dan tinggal di Jepang secara mandiri dengan dukungan dari LPK.</p>

                    <h4>Bidang Pekerjaan:</h4>
                    <ul>
                        <li>Caregiver (Perawat Lansia)</li>
                        <li>Pertanian</li>
                        <li>Konstruksi</li>
                        <li>Pengolahan Makanan</li>
                    </ul>

                    <h4>Persyaratan:</h4>
                    <ul>
                        <li>Usia 18-35 Tahun</li>
                        <li>Memiliki sertifikat bahasa Jepang (JLPT N4 / JFT Basic A2)</li>
                        <li>Memiliki sertifikat skill (SSW) sesuai bidang</li>
                    </ul>
                ',
            ],
        ];

        foreach ($programs as $program) {
            // updateOrCreate prevents duplicates if you run the seeder multiple times
            Program::updateOrCreate(
                ["slug" => $program["slug"]], // Check by slug
                $program, // Update/Create data
            );
        }
    }
}
