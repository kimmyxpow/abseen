<?php

namespace Database\Seeders;

use App\Models\Rayon;
use App\Models\Rombel;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Rombel::create([
            'name' => 'RPL XI-2'
        ]);

        Rombel::create([
            'name' => 'RPL XI-1'
        ]);

        Rayon::create([
            'name' => 'Cisarua 1'
        ]);

        Rayon::create([
            'name' => 'Cisarua 2'
        ]);

        User::create([
            'name' => 'Abi Noval Fauzi',
            'nis' => '12007616',
            'rombel_id' => 1,
            'rayon_id' => 1,
            'username' => 'anf612',
            'email' => 'abinovalfauzi@smkwikrama.sch.id',
            'password' => bcrypt('password'),
            'role' => 'Admin',
            'avatar' => '/img/avatar/a.png'
        ]);

        User::create([
            'name' => 'Siswa 1',
            'nis' => '12001111',
            'rombel_id' => 2,
            'rayon_id' => 1,
            'username' => 'asdasd',
            'email' => 'asdasd@smkwikrama.sch.id',
            'password' => bcrypt('password'),
            'role' => 'Siswa',
            'avatar' => '/img/avatar/s.png'
        ]);

        User::create([
            'name' => 'Siswa 2',
            'nis' => '12001112',
            'rombel_id' => 1,
            'rayon_id' => 2,
            'username' => 'asdasdasd',
            'email' => 'asdasdasd@smkwikrama.sch.id',
            'password' => bcrypt('password'),
            'role' => 'Siswa',
            'avatar' => '/img/avatar/s.png'
        ]);
    }
}
