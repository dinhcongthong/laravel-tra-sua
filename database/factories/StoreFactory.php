<?php

namespace Database\Factories;

use App\Models\Gallery;
use App\Models\StoreStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'note' => 'Nothing',
            'store_status_id' => StoreStatus::all()->random()->id,
            'gallery_id' => Gallery::all()->random()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
