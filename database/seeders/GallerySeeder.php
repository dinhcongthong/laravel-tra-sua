<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;
use DB;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gallery')->insert(
            [
                'name' => null,
                'url' => 'https://phuclong.com.vn/uploads/post/20649d183ca5f1-bannertrangchu.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }
}
