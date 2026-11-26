<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Kopi Lampung',
                'slug' => 'kopi-lampung',
                'description' => 'Biji kopi dan kopi bubuk pilihan dari dataran tinggi Lampung dengan aroma kuat dan karakter rasa khas.',
            ],
            [
                'name' => 'Keripik dan Camilan',
                'slug' => 'keripik-dan-camilan',
                'description' => 'Aneka keripik pisang renyah dan camilan tradisional khas Lampung dengan berbagai varian rasa.',
            ],
            [
                'name' => 'Sambal dan Makanan',
                'slug' => 'sambal-dan-makanan',
                'description' => 'Olahan sambal rumahan dan makanan khas Lampung siap saji dengan bumbu rempah autentik.',
            ],
            [
                'name' => 'Oleh-Oleh Khas Lampung',
                'slug' => 'oleh-oleh-khas-lampung',
                'description' => 'Pilihan buah tangan istimewa khas Lampung untuk keluarga, kerabat, dan rekan kerja.',
            ],
            [
                'name' => 'Minuman Tradisional',
                'slug' => 'minuman-tradisional',
                'description' => 'Minuman rempah dan olahan segar khas Lampung yang menyehatkan dan nikmat disajikan hangat maupun dingin.',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
