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
                'name' => 'Active',
                'color_class' => 'bg-success',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'name' => 'Inactive',
                'color_class' => 'bg-secondary',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]
        ];
        DB::table('product_status')->insert($data);
    }
}
