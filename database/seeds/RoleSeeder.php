<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Admin',
            'CEO',
            'CTO',
            'Manager',
            'Senior Developer',
            'Developer',
            'Designer',
        ];
        
        Role::truncate();
        foreach ($roles as $role) {
            Role::create([
                'name' => $role
            ]);
        }
    }
}
