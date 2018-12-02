<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_regular = Role::where('name', 'regular')->first();
        $role_admin  = Role::where('name', 'admin')->first();

        $regular = new User();
        $regular->name = 'Regular User Name';
        $regular->email = 'user@example.com';
        $regular->password = bcrypt('password');
        $regular->save();
        $regular->roles()->attach($role_regular);

        $admin = new User();
        $admin->name = 'Admin Name';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('password');
        $admin->save();
        $admin->roles()->attach($role_admin);
    }
}
