<?php

namespace Database\Seeders;

use App\Models\Rayon;
use App\Models\Rombel;
use App\Models\User;
use Database\Factories\StudentFactory;
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
        for ($i=1; $i <= 5; $i++) { 
            Rombel::create([
                'name' => 'RPL XI-' . $i
            ]);
        }

        for ($i=1; $i <= 5; $i++) { 
            Rombel::create([
                'name' => 'MMD XI-' . $i
            ]);
        }

        for ($i=1; $i <= 5; $i++) { 
            Rombel::create([
                'name' => 'TKJ XI-' . $i
            ]);
        }

        for ($i=1; $i <= 5; $i++) { 
            Rombel::create([
                'name' => 'RPL X-' . $i
            ]);
        }

        for ($i=1; $i <= 5; $i++) { 
            Rombel::create([
                'name' => 'MMD X-' . $i
            ]);
        }

        for ($i=1; $i <= 5; $i++) { 
            Rombel::create([
                'name' => 'TKJ X-' . $i
            ]);
        }

        for ($i=1; $i <= 5; $i++) { 
            Rombel::create([
                'name' => 'RPL XII-' . $i
            ]);
        }

        for ($i=1; $i <= 5; $i++) { 
            Rombel::create([
                'name' => 'MMD XII-' . $i
            ]);
        }

        for ($i=1; $i <= 5; $i++) { 
            Rombel::create([
                'name' => 'TKJ XII-' . $i
            ]);
        }

        for ($i=1; $i <= 5; $i++) { 
            Rayon::create([
                'name' => 'Cisarua ' . $i
            ]);
        }

        for ($i=1; $i <= 5; $i++) { 
            Rayon::create([
                'name' => 'Ciawi ' . $i
            ]);
        }

        for ($i=1; $i <= 5; $i++) { 
            Rayon::create([
                'name' => 'Cibedug ' . $i
            ]);
        }

        User::create([
            'name' => 'Abi Noval Fauzi',
            'username' => 'anf612',
            'email' => 'abinovalfauzi@smkwikrama.sch.id',
            'password' => bcrypt('password'),
            'role' => 'Admin',
            'hash' => md5(bcrypt('abinovalfauzi@smkwikrama.sch.id')),
            'avatar' => '/img/avatar/a.png'
        ]);

        User::factory(1200)->create();
    }
}
