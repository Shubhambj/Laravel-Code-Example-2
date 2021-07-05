<?php

use Illuminate\Database\Seeder;
use App\Models\Common\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stateData = file_get_contents(public_path('db_json/states.json'));
        $states = json_decode($stateData, true)['states'];

        State::truncate();
        foreach ($states as $state) {
            State::create([
                'name' => $state['name'],
                'country_id' => $state['country_id'],
            ]);
        }
    }
}
