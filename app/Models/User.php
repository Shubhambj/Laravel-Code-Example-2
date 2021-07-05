<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Address;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'dob', 'image', 'email_verification_token', 'is_address_same'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * @description used to delete relational data while deleting user
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 05.07.21
     * @version v1
     * @param 
     * @return 
     */
    public static function boot() {
        parent::boot();

        static::deleting(function($user) {
            $user->addresses()->delete();
            
            foreach ($user->roles as $role) {
                $user->roles()->detach($role);
            }
        });
    }
    
    /**
     * @description used to get the address data belongs to user.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 05.07.21
     * @version v1
     * @param 
     * @return object
     */
    public function addresses() {
        return $this->hasMany(Address::class, 'user_id', 'id');
    }
    
    /**
     * @description used to get the roles data belongs to user.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 05.07.21
     * @version v1
     * @param 
     * @return object
     */
    public function roles() {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
