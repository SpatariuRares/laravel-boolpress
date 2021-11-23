<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['HTML', 'CSS', 'JS', 'PHP', 'LARAVEL', 'Vue Cli'];
        for($i = 0; count($categories); $i++){
            $new_category = new Category();
            $new_category->name = $categories[$i];
            $new_category->slug = Str::slug($categories[$i]);
            $new_category->save();
        }
    }
}
