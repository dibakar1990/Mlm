<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                'status' => 1,
                'password' => bcrypt('123456'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
        ];
    }
}
