<?php

namespace App\Helpers;

use App\Models\Role;
use App\Models\Common\City;
use App\Models\Common\State;

class CommonHelper {
    
    public static function getRoles() {
        return Role::get();
    }
    
    public static function getCities() {
        return City::get();
    }
    
    public static function getStates() {
        return State::where('country_id', 101)->get();
    }
}