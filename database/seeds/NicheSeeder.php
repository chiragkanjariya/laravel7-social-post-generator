<?php

use Illuminate\Database\Seeder;
use App\Models\Niche;

class NicheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Niche::create(['name' => 'Sports']);
        Niche::create(['name' => 'Model']);
        Niche::create(['name' => 'Science']);
    }
}
