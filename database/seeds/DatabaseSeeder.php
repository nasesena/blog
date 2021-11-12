<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // PostsTableSeederをここで呼び出す。
        $this->call(PostsTableSeeder::class);
    }
}
