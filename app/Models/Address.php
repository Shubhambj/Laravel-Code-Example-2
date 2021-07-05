<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\City;
use App\Models\Common\State;

class Address extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'user_id'
    ];
    
    /**
     * @description used to get city name on address object.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 05.07.21
     * @version v1
     * @param 
     * @return string
     */
    public function getCityNameAttribute() {
        $cityId = $this->city_id;
        return is_null($cityId) ? '' : City::where('id', $cityId)->value('name');
    }
    
    /**
     * @description used to get state name on address object.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 05.07.21
     * @version v1
     * @param 
     * @return string
     */
    public function getStateNameAttribute() {
        $stateId = $this->state_id;
        return is_null($stateId) ? '' : State::where('id', $stateId)->value('name');
    }
}
