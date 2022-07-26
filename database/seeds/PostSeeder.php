<?php

use App\Models\Post;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Category;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories_ids = Category::all()->pluck('id');    // funzione pluck() che mi permette di estrarre solo quello che gli chiedo (in questo caso un array di id)

        for ($i = 0; $i < 150; $i++){
            $post = new Post;
            // $post->title = $faker->words(rand(2, 4), true);
            $post->category_id = $faker->randomElement($categories_ids);
            $post->title = 'Ciao a tutti!@';
            $post->slug = Post::getSlug($post->title);
            $post->image = 'https://picsum.photos/id/' . rand(1,300) . '/500/300';
            $post->content = $faker->paragraphs(rand(2,10), true);
            $post->excerpt = $faker->paragraph();
            $post->save();
            // cercare fakerphp (fakerphp.github.io)
        }
    }
}
