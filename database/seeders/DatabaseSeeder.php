<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Job;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(5)->create();

        Job::factory(10)->create();

        // Job::create([
        //     'title' => 'Senior PHP Developer',
        //     'tags' => 'php, laravel, mysql',
        //     'company' => 'Wise',
        //     'location' => 'London, UK',
        //     'email' => 'hr@wise.com',
        //     'website' => 'https://wise.com',
        //     'description' => 'We are looking for a PHP developer to join our team. You will be working on a new project using Laravel and MySQL. You will be working remotely with a team of 5 other developers.',
        // ]);
    }
}
