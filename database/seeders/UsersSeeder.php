<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::where('name', 'Admin')->first();
        $sellerRole = Role::where('name', 'Seller')->first();
        $customerRole = Role::where('name', 'Customer')->first();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
        ]);

        User::create([
            'name' => 'Seller',
            'email' => 'seller@mail.com',
            'password' => Hash::make('password'),
            'role_id' => $sellerRole->id,
        ]);

        User::create([
            'name' => 'Customer',
            'email' => 'customer@mail.com',
            'password' => Hash::make('password'),
            'role_id' => $customerRole->id,
        ]);
    }
}
