<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Factories\ChirpFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ChirpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(20)->create();
        ChirpFactory::times(100)->create();
    }
}
