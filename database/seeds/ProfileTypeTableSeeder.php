<?php

use Illuminate\Database\Seeder;
use App\Models\ProfileType;

class ProfileTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      ProfileType::create(['name' => 'Sports']);
      ProfileType::create(['name' => 'Model']);
      ProfileType::create(['name' => 'Science']);
    }
}
