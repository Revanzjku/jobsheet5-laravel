<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\StudentParent;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $classroom = ['XI PPLG 1', 'XI PPLG 2'];

        foreach( $classroom as $class ) {
            Classroom::create(['class_name' => $class]);
        }

        StudentParent::factory(10)->create();
        Student::factory(10)->create();
    }
}
