<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\classes;
use App\Models\section;
use App\Models\student;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ClassesSeeder extends Seeder
{
    public function run(): void
    {
        classes::factory()
            ->count(10)
            ->sequence(fn($sequence) => ['name' => 'Class ' . ($sequence->index + 1)])
            ->has(
                section::factory()
                    ->count(2)
                    ->state(
                        new Sequence(
                            ['name' => 'Section A'],
                            ['name' => 'Section B'],
                        )
                    )
                    ->has(
                        student::factory()
                            ->count(5)
                            ->state(function(array $attributes, section $section) {
                                return [
                                    'class_id' => $section->class_id,
                                    'section_id' => $section->id,
                                ];
                            })
                    )
            )
            ->create();
    }
}
