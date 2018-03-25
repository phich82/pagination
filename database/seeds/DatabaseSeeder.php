<?php

use Illuminate\Database\Seeder;
use MileBasicSettingsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * First, run: composer dump-autoload
     * Next, run: php artisan db:seed or php artisan db:seed --class=PostsTableSeeder
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            //PostsTableSeeder::class,
            MileBasicSettingsTableSeeder::class,
        ]);
    }
}
