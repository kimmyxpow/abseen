<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'nis' => $this->faker->unique()->randomNumber(8, true),
            'rombel_id' => mt_rand(1, 45),
            'rayon_id' => mt_rand(1, 15),
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'role' => 'Siswa',
            'hash' => md5(bcrypt($this->faker->unique()->safeEmail() . $this->faker->unique()->userName() . time() . uniqid())),
            'avatar' => '/img/avatar/' . substr($this->faker->name(), 0, 1) . '.png'
        ];
    }
}
