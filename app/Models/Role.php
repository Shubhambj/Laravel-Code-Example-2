<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * @description used to get the users data belongs to role.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 05.07.21
     * @version v1
     * @param 
     * @return object
     */
    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
