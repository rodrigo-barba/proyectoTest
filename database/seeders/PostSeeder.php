<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Post::truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // genero 50 registros de posteos, iniciando desde 100
        for ($i=100; $i < 200; $i++) {

            //genero valores al azar p/cada registro
            $title = Str::random(30);
            $category_id = Category::inRandomOrder()->pluck('id')->first();

            Post::create (
            [
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => "<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. $i </p>",
                'category_id' => $category_id,
                'description' => "Dolores sequi quam odit ipsa consequuntur. $i",
                'posted' => "yes",
                //'image' =>   todavia no tengo ese valor
                'user_id' => 1
            ]);
        }
    }


}
