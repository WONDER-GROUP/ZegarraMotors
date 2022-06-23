<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $user = User::create([
            'username' => 'Herald',
            'email' => 'heraldcnp@gmail.com',
            'password' => bcrypt('123'),
        ]);

        $user->people()->create([
            'name' => 'Herald',
            'f_last_name' => 'Choque',
            'm_last_name' => 'Vargas',
            'nit' => '6680287',
            'cellphone' => '72367995',
            'address' => 'H vasquez 186',
        ]);
    }
}
