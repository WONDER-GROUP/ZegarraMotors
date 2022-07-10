<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
        * Create roles and permissions.
        * admin, mechanic, support
        */
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        
        // create permissions for admin
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'read user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'register user']);
        Permission::create(['name' => 'deregister user']);

        // create permissions for mechanic
        Permission::create(['name' => 'read service']);
        Permission::create(['name' => 'update service']);
        Permission::create(['name' => 'delete service']);
        Permission::create(['name' => 'read inventory']);
        Permission::create(['name' => 'update inventory']);

        // create roles and assign existing permissions to support
        $support = Role::create(['name' => 'Apoyo']);
        $support->givePermissionTo('read service');
        $support->givePermissionTo('read inventory');

        // create roles and assign existing permissions to mechanic
        $mechanic = Role::create(['name' => 'Mecanico']);
        $mechanic->givePermissionTo('read service');
        $mechanic->givePermissionTo('update service');
        $mechanic->givePermissionTo('delete service');
        $mechanic->givePermissionTo('read inventory');
        $mechanic->givePermissionTo('update inventory');

        // create roles and assign existing permissions to an administrator
        $admin = Role::create(['name' => 'Administrador']);
        $admin->givePermissionTo('read service');
        $admin->givePermissionTo('update service');
        $admin->givePermissionTo('delete service');
        $admin->givePermissionTo('read inventory');
        $admin->givePermissionTo('create user');
        $admin->givePermissionTo('read user');
        $admin->givePermissionTo('update user');
        $admin->givePermissionTo('register user');
        $admin->givePermissionTo('deregister user');

        //Create an admin
        User::create([
            'username' => 'Herald',
            'email' => 'heraldcnp@gmail.com',
            'password' => bcrypt('123'),
            'email_verified_at' => now()
        ])->assignRole($admin)->people()->create([
            'name' => 'Herald',
            'f_last_name' => 'Choque',
            'm_last_name' => 'Vargas',
            'nit' => '6680287',
            'cellphone' => '72367995',
            'address' => 'H vasquez 186',
        ]);

        //Create a mechanic
        User::create([
            'username' => 'mechanic',
            'email' => 'mechanic@gmail.com',
            'password' => bcrypt('123'),
            'email_verified_at' => now()
        ])->assignRole($mechanic)->people()->create([
            'name' => 'mechanic',
            'f_last_name' => 'mechanic',
            'm_last_name' => 'mechanic',
            'nit' => '9966558',
            'cellphone' => '74512632',
            'address' => 'Stret XX',
        ]);

        //Create a support
        User::create([
            'username' => 'support',
            'email' => 'support@gmail.com',
            'password' => bcrypt('123'),
            'email_verified_at' => now()
        ])->assignRole($support)->people()->create([
            'name' => 'support',
            'f_last_name' => 'support',
            'm_last_name' => 'support',
            'nit' => '5214632',
            'cellphone' => '96854721',
            'address' => 'Stret YY',
        ]);
    }
}
