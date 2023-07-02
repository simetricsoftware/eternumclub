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

        if (app()->environment('local')) {
            $organizer = App\User::create([
                'name'              => 'organizer',
                'lastname'          => 'organizer',
                'email'             => 'organizer@organizer.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('organizer'),
                'remember_token'    => Str::random(10),
            ]);
            $organizer->assignRole('organizer');

            $guest = App\User::create([
                'name'              => 'guest',
                'lastname'          => 'guest',
                'email'             => 'guest@guest.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('guest'),
                'remember_token'    => Str::random(10),
            ]);
            $guest->assignRole('guest');

            $roles = array('organizer', 'guest');
            factory(App\User::class, 50)->create()->each(function($user) use ($roles) {
                $user->assignRole($roles[rand(0,1)]);
            });
        }

    }
}
