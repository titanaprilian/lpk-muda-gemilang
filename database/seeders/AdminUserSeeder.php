<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::where("email", "admin@muda.gemilang")->doesntExist()) {
            User::create([
                "name" => "Super Admin",
                "email" => "admin@muda.gemilang",
                "password" => Hash::make("lpkmudagemilang123"),
                "role" => "Admin",
                "email_verified_at" => now(),
                "created_at" => now(),
                "updated_at" => now(),
            ]);

            echo "Admin user created successfully.\n";
        } else {
            echo "Admin user already exists. Skipping creation.\n";
        }
    }
}
