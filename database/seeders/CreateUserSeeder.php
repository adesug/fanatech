<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name'      => 'SuperAdmin',
                'email'     => 'superadmin@mail.com',
                'role'      => 'SuperAdmin',
                'password'  => bcrypt('1234567890'),
            ],
            [
                'name'     => 'Sales',
                'email'    => 'sales@mail.com',
                'role'     => 'Sales',
                'password' => bcrypt('1234567890')
            ],
            [
                'name'      => 'Purchase',
                'email'     => 'purchase@mail.com',
                'role'      => 'Purchase',
                'password'  => bcrypt('1234567890')
            ],
            [
                'name'      => 'Manager',
                'email'     => 'manager@mail.com',
                'role'      => 'Manager',
                'password'  => bcrypt('1234567890')
            ],
        ];
        foreach($user as $key => $value) {
            User::create($value);
        }

    }
}
