<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'JohnSmith',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole('administrator');

        $user = User::create([
            'name' => 'Marry Jone',
            'email' => 'user@user.com',
            'password' => bcrypt('password')
        ]);
        $user->assignRole('user');

    }
}
