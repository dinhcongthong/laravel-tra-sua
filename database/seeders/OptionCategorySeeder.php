<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class OptionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Size',
            ],
            [
                'name' => 'Topping'
            ],
            [
                'name' => 'Đá'
            ],
            [
                'name' => 'Đường'
            ]
        ];

        DB::table('option_categories')->insert($data);
    }
}
