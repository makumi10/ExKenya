<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CountySeeder::class);
        $this->call(CitySeeder::class);
        $this->call(HotelSeeder::class);
        $this->call(RestaurantSeeder::class);
        $this->call(PointOfInterestSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}