<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = Grade::all();
        $subjects = ['Math', 'Biology', 'Chemistry', 'Geography', 'Art', 'English'];

        foreach ($grades as $grade) {
            for ($i = 0; $i < $grade->capacity; $i++) {

                $student = new Student();
                $student->name = fake()->name();
                $student->grade()->associate($grade);
                $student->save();

                foreach ($subjects as $subject) {
                    $temp = new Subject();

                    $temp->name = $subject;
                    $temp->exercises = [rand(80, 95), rand(85, 90), rand(90, 95), rand(80, 100)];
                    $temp->daily_test = [rand(80, 90), rand(80, 95)];
                    $temp->midterm_test = rand(80, 99);
                    $temp->semester_test = rand(80, 99);

                    $student->subjects()->save($temp);
                }
            }
        }
    }
}
