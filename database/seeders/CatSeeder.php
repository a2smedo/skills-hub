<?php

namespace Database\Seeders;

use App\Models\Cat;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class CatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cat::factory()->has(
            Skill::factory()->has(
                Exam::factory()->has(
                    Question::factory()->count(15)
                )->count(3)
            )->count(6)
        )->count(3)->create();
    }
}
