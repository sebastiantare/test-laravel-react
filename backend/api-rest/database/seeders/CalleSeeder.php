<?php

namespace Database\Seeders;

use App\Models\Calle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Calle::factory()->count(500)->create();
    }
}
