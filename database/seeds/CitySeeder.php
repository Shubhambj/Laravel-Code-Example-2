<?php

use Illuminate\Database\Seeder;
use App\Models\Common\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $citiesData = file_get_contents(public_path('db_json/cities.json'));
        $cities = json_decode($citiesData, true)['cities'];
        $citiesChunks = array_chunk($cities, 500);

        City::truncate();
        foreach ($citiesChunks as $cities) {
            City::insert($cities);
        }
    }
}
