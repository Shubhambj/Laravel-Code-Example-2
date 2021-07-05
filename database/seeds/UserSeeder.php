<?php

use Illuminate\Database\Seeder;
use App\Models\User;

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
            'image' => 'avatar.jpg'
        ])->roles()->attach([1]);
    }
}
