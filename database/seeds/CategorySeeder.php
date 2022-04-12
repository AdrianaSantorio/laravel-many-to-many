<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['label' => 'HTML', 'color' => 'info'],
            ['label' => 'CSS', 'color' => 'danger'],
            ['label' => 'PHP', 'color' => 'warning'],
            ['label' => 'Laravel', 'color' => 'success'],
            ['label' => 'VueJS', 'color' => 'primary']
        ];

        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->fill($category);
            $newCategory->save();
        }
    }
}
