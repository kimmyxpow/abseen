<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'name' => 'Abi Noval Fauzi',
            'nis' => '12007616',
            'rombel' => 1,
            'rayon' => 1,
            'username' => 'anf612',
            'email' => 'abinovalfauzi@smkwikrama.sch.id',
            'password' => bcrypt('password'),
            'role' => 'Admin',
            'avatar' => '/img/avatar/a.png'
        ]);
    }
}
