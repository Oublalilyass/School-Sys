<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\section; // lowercase if your model is lowercase
use App\Models\classes; // needed if you want to attach each section to a class

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        // Get all classes
        $classes = classes::all();

        foreach ($classes as $class) {
            // Create 2 sections per class
            section::factory()
                ->count(2)
                ->state(function () use ($class) {
                    return [
                        'class_id' => $class->id,
                        'name' => fake()->randomElement(['Section A', 'Section B']),
                    ];
                })
                ->create();
        }
    }
}
