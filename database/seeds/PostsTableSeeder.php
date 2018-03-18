<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  insert 50 rows into 'posts' table
        factory(Post::class, 40000)->create();
    }
}
