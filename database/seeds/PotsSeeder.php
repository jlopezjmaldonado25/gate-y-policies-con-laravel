<?php

use App\Post;
use Illuminate\Database\Seeder;

class PotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Post::class)->times(30)->create();
    }
}
