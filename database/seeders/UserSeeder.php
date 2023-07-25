<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        
        User::create([
                'type' => 1,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'status' => 1,
                'password' => bcrypt('123456'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
        ])->assignRole('admin');
    }
}
