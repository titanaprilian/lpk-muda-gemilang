<?php

namespace Database\Factories;

use App\Models\Registrant;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegistrantFactory extends Factory
{
    protected $model = Registrant::class;

    public function definition(): array
    {
        return [
            "program_id" => $this->faker->numberBetween(1, 3),
            "full_name" => $this->faker->name(),
            "birth_place" => $this->faker->city(),
            "date_of_birth" => $this->faker->date(),
            "age" => $this->faker->numberBetween(18, 25),
            "gender" => $this->faker->randomElement(["Pria", "Wanita"]),
            "address" => $this->faker->address(),
            "phone_number" => $this->faker->phoneNumber(),
            "email" => $this->faker->safeEmail(),
            "registration_date" => $this->faker->dateTimeBetween(
                "-1 year",
                "now",
            ),
            "status" => $this->faker->randomElement([
                "Pending",
                "Verified",
                "Accepted",
                "Rejected",
            ]),
        ];
    }
}
