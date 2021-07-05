<?php

use Illuminate\Database\Seeder;
use App\Models\Common\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countryData = file_get_contents(public_path('db_json/countries.json'));
        $countries = json_decode($countryData, true)['countries'];

        Country::truncate();
        foreach ($countries as $country) {
            Country::create([
                'name' => $country['name'],
                'code' => $country['sortname'],
                'phone_code' => $country['phoneCode']
            ]);
        }
    }
}
