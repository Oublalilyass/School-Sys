<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\student;
use App\Models\section;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // Get all sections from the database
        $sections = section::all();

        // Loop through each section and create 5 students
        foreach ($sections as $section) {
            student::factory()
                ->count(5)
                ->state(function(array $attributes) use ($section) {
                    return [
                        'section_id' => $section->id,
                        'class_id' => $section->class_id, // link student to class
                    ];
                })
                ->create();
        }
    }
}
