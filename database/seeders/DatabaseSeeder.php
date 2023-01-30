<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PostSeeder::class,
            CategoryTableSeeder::class,
            PostCategorySeeder::class,
            TagsTableSeeder::class,
            PostsTagsTableSeeder::class,
        ]);
    }
}
