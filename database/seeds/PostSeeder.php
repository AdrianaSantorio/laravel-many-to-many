<?php

use Illuminate\Database\Seeder;
use \App\Models\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Support\Arr;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //
        $category_ids = Category::pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post->category_id = Arr::random($category_ids);
            $post->title = $faker->text(30);
            $post->content = $faker->paragraphs(5, true);
            $post->image = ('https://picsum.photos/50/50');
            $post->slug = Str::slug($post->title, '-');
            $post->save();
        }
    }
}
