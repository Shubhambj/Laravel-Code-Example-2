<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Address; 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'first_name' => 'Shubham',
            'last_name' => 'Bhardwaj',
            'email' => 'shubham.bj@gmail.com',
            'password' => bcrypt('pass@123'),
            'is_email_verified' => 1,
            'email_verified_at' => date('Y-m-d H:i:s'),
            'email_verification_token' => Str::random(40),
            'dob' => '1991-09-27',
            'image' => 'avatar.jpg',
            'is_address_same' => 1
        ])->roles()->attach([1]);
        
        Address::truncate();
        Address::create([
            'user_id' => 1,
            'type' => 1,
            'line_one' => 'address line one',
            'line_two' => 'address line two',
            'city_id' => 1,
            'state_id' => 1,
            'country_id' => 101,
        ]);
        
        \File::copy(public_path('images/avatar-1.jpg'), storage_path('app/public/images/users/avatar.jpg'));
    }
}
