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
        $user = \App\Models\User::where('id', 1)->first();

        $articles = [
            [
                'title' => 'Gunung Ciremai Menjadi Daya Tarik Pendaki Gunung Indonesia',
                'category' => 'Alam',
                'slug' => \Illuminate\Support\Str::slug('Gunung Ciremai Menjadi Daya Tarik Pendaki Gunung Indonesia'),
                'description' => 'Gunung Ceremai adalah gunung berapi kerucut yang secara administratif termasuk dalam wilayah dua kabupaten, yakni Kabupaten Kuningan dan Kabupaten Majalengka, Provinsi Jawa Barat.',
                'created_by' => $user->id,
            ],
            [
                'title' => 'Papalidan: Serunya Mengarungi Sungai dengan Ban Bekas, Pengalam Tak Terlupakan',
                'category' => 'Olahraga',
                'slug' => \Illuminate\Support\Str::slug('Papalidan: Serunya Mengarungi Sungai dengan Ban Bekas, Pengalam Tak Terlupakan'),
                'description' => 'Permainan tradisional anak-anak yang menyusuri sungai dengan ban bekas. Seru dan menantang, permainan ini mengajarkan keberanian, cinta alam, dan kebersamaan.',
                'created_by' => $user->id,
            ],
            [
                'title' => 'Lezatnya Kuliner Sawah Lope: Cita Rasa Tradisional di Tengah Alam Pedesaan',
                'category' => 'Kuliner',
                'slug' => \Illuminate\Support\Str::slug('Lezatnya Kuliner Sawah Lope: Cita Rasa Tradisional di Tengah Alam Pedesaan'),
                'description' => 'Sawah Lope menyajikan kuliner khas Sunda, seperti nasi oncom, sayur lodeh, dan jajanan tradisional. Hidangan autentik ini nikmat dinikmati di tengah suasana alam pedesaan yang asri.',
                'created_by' => $user->id,
            ],
            [
                'title' => 'Olahraga Seru di Sawah Lope: Nikmati Alam Sambil Menjaga Kebugaran',
                'category' => 'Olahraga',
                'slug' => \Illuminate\Support\Str::slug('Olahraga Seru di Sawah Lope: Nikmati Alam Sambil Menjaga Kebugaran'),
                'description' => 'Olahraga di Sawah Lope, seperti yoga, bersepeda, dan jogging, memberikan manfaat kebugaran sambil menikmati keindahan alam pedesaan yang hijau dan udara segar.',
                'created_by' => $user->id,
            ]
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
