<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = ['Admin', 'Seller', 'Customer'];

        foreach ($roles as $role) {
            //Supaya tidak double data kalau seeder dijalankan ulang
            Role::firstOrCreate(['name' => $role]);
        }
    }
}
