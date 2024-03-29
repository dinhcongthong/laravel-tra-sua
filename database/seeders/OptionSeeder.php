<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class OptionSeeder extends Seeder
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
                'name' => 'M',
                'sort_no' => 1,
                'option_category_id' => 1,
            ],
            [
                'name' => 'L',
                'sort_no' => 2,
                'option_category_id' => 1,
            ],
            [
                'name' => 'XL',
                'sort_no' => 3,
                'option_category_id' => 1,
            ],
            [
                'name' => 'Trân châu trắng',
                'sort_no' => 1,
                'option_category_id' => 2
            ],
            [
                'name' => 'Trân châu đen',
                'sort_no' => 2,
                'option_category_id' => 2
            ],
            [
                'name' => 'Thạch dừa',
                'sort_no' => 3,
                'option_category_id' => 2
            ],
            [
                'name' => 'Bánh flan',
                'sort_no' => 4,
                'option_category_id' => 2
            ]
        ];

        DB::table('option')->insert($data);
    }
}
