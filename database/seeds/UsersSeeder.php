<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = App\User::create([
            'name'              => 'admin',
            'lastname'          => 'admin',
            'email'             => 'admin@admin.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('admin'),
            'remember_token'    => Str::random(10),
        ]);
        $admin->assignRole('admin');

        $moderator = App\User::create([
            'name'              => 'moderator',
            'lastname'          => 'moderator',
            'email'             => 'moderator@moderator.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('moderator'),
            'remember_token'    => Str::random(10),
        ]);
        $moderator->assignRole('moderator');

        $writer = App\User::create([
            'name'              => 'writer',
            'lastname'          => 'writer',
            'email'             => 'writer@writer.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('writer'),
            'remember_token'    => Str::random(10),
        ]);
        $writer->assignRole('writer');

        $guest = App\User::create([
            'name'              => 'guest',
            'lastname'          => 'guest',
            'email'             => 'guest@guest.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('guest'),
            'remember_token'    => Str::random(10),
        ]);
        $guest->assignRole('guest');

        $roles = array('moderator', 'writer', 'guest');
        factory(App\User::class, 50)->create()->each(function($user) use ($roles) {
            $user->assignRole($roles[rand(0,2)]);
        });

    }
}
