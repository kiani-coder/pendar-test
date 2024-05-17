<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::create([
            'title' => 'The Importance of Sleep for Mental Health',
            'content' => 'Sleep plays a crucial role in mental health. Studies have shown that lack of sleep can lead to increased stress, anxiety, and depression...',
            'image_path' => 'images/sleep_mental_health.jpg',
        ]);

        Article::create([
            'title' => '10 Tips for Better Time Management',
            'content' => 'Effective time management can significantly improve productivity and reduce stress levels. Here are 10 tips to help you manage your time more efficiently...',
            'image_path' => 'images/time_management_tips.jpg',
        ]);
    }
}
