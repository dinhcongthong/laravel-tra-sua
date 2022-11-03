<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductStatusSeeder extends Seeder
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
                'name' => 'Hoạt động',
                'color_class' => 'bg-success',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'name' => 'Không hoạt động',
                'color_class' => 'bg-secondary',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]
        ];
        DB::table('product_status')->insert($data);
    }
}
