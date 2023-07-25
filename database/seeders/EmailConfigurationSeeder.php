<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmailConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emailConfiguration = [
            'driver' => 'smtp',
            'host' => 'smtp.gmail.com',
            'port' => '465',
            'encryption' => 'ssl',
            'user_name' => 'dibakar.swadeshsoftwares@gmail.com',
            'password' => 'igrwdsupynwnzsla',
            'from_address' => 'dibakar.swadeshsoftwares@gmail.com',
            'from_name' => 'MlmLab',
        ];
        \App\Models\EmailConfiguration::factory()->create($emailConfiguration);
    }
}
