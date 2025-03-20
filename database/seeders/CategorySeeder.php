<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        //trunco la tabla
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // Category::truncate();
        // db::statement('SET FOREIGN_KEY_CHECKS=1');

        // genero 200 registros de categoria, iniciando desde 100
        for ($i=100; $i < 200; $i++) {
            Category::create (
            [
                'title' => "Categoria $i",
                'slug' => "categoria-$i"
            ]
            );
        }
    }
}
