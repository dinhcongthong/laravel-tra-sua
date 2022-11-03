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
                'name' => 'Chờ xác nhận',
                'color_class' => 'bg-warning',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'name' => 'Đã xác nhận',
                'color_class' => 'bg-success',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'name' => 'Đã giao',
                'color_class' => 'bg-white',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]
        ];
        DB::table('order_status')->insert($data);
    }
}
