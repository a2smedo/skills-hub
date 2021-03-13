<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ahmed Salah',
            'email' => 'suber_admin@skillshub.com',
            'password' => Hash::make('123456'),
            'role_id' => 1
        ]);
    }
}
