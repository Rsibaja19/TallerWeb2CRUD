<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        //
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('12345'),
                'is_admin' => 1
            ],
            [
                'name' => 'user',
                'email' => 'user@user.com',
                'password' => bcrypt('12345'),
                'is_admin' => 0
            ]
        ];

        foreach ($users as $key => $user) {
            # code...
            User::create($user);
        }
    }
}
