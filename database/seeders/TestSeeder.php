<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 30001; $i <= 100000; $i++) {
            $notes = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec auctor enim nec faucibus venenatis. Maecenas mauris odio, efficitur sed leo id, molestie tincidunt neque. Maecenas diam enim, fermentum vitae mauris vel, ultrices fringilla lacus. Nulla neque purus, mattis in quam non, posuere imperdiet nisi. In varius risus vel ipsum molestie, ac ultricies neque dapibus. Proin metus libero, porta at dictum elementum, dictum ac lorem. Nam non vestibulum arcu. Praesent malesuada justo a erat gravida consectetur.';
            $data = [
                'name' => 'Dinh Cong Thong ' . $i,
                'age' => 'Mười tám tuổi ' . $i,
                'notes' => $notes
            ];
            DB::table('tests')->insert($data);
        }
    }
}
