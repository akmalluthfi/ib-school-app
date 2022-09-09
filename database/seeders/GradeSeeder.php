<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = 1;
        $grades = ['A', 'B', 'C', 'D', 'E', 'F'];
        for ($i = 1; $i <= 3; $i++) {
            foreach ($grades as $grade) {
                Grade::create([
                    'name' => "$i-$grade",
                    'teacher' => $this->generateName(),
                    'capacity' => rand(36, 40),
                    'room' => "R-$rooms",
                ]);
                $rooms++;
            }
        }
    }

    private function generateName()
    {
        $gender = fake()->randomElement(['male', 'female']);
        $name = fake()->firstName($gender) . " " . fake()->lastName();
        return fake()->title($gender) . " " . $name;
    }
}
