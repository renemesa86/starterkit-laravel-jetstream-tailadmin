<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'rene',
            'email' => 'rene@gmail.com',
            'phone' => 54281261,
            'password'       => bcrypt('123456789'),
            'remember_token' => null,
            'profile_photo_path' => 'profile-photos/1.jpg',
        ])->roles()->sync([1]);

        User::create([
            'name' => 'cliente',
            'email' => 'cliente@gmail.com',
            'phone' => 54281261,
            'password'       => bcrypt('123456789'),
            'remember_token' => null,
            'profile_photo_path' => 'profile-photos/1.jpg',
        ])->roles()->sync([2]);

        User::create([
            'name' => 'cliente2',
            'email' => 'cliente2@gmail.com',
            'phone' => 54281261,
            'password'       => bcrypt('123456789'),
            'remember_token' => null,
            'profile_photo_path' => 'profile-photos/1.jpg',
        ])->roles()->sync([2]);
    }
}
