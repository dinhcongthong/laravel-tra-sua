<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
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
                'name' => 'Waiting for confirmation',
                'color_class' => 'bg-warning',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'name' => 'Confirmed',
                'color_class' => 'bg-success',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'name' => 'Delivered',
                'color_class' => 'bg-white',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]
        ];
        DB::table('order_status')->insert($data);
    }
}
