<?php

use App\Mile;
use Illuminate\Database\Seeder;

class MileBasicSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Mile::class, 20)->create();
    }
}
