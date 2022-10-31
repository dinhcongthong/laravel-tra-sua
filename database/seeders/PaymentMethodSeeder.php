<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
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
                'name' => 'MOMO',
                'note' => 'ko co gi',
                'gallery_id' => 1
            ],
            [
                'name' => 'CASH',
                'note' => 'ko co gi',
                'gallery_id' => 1
            ]
        ];
        DB::table('payment_methods')->insert($data);
    }
}
