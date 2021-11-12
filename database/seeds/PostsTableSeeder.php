<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // モデルファクトリの呼び出し
        DB::table('posts')->truncate();
        factory(App\Post::class, 5)->create();
        /*
        factory(App\User::class, 50)->create()->each(function ($u) {
            $u->posts()->save(factory(App\Post::class)->make());
        });*/        
        //
    }
}
