<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = [
            'title' => 'logo title',
            'email' => 'contact@domain.com',
            'mobile_number' => '0123456789',
            'address' => 'Tarakeswar saradapally',
            'file_path_squre' => null,
            'file_path_vertical' => null,
            'direct_bonus' => 0,
        ];
        \App\Models\Setting::factory()->create($setting);
    }
}
