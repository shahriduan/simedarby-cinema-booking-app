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
        User::firstOrCreate([
            'first_name' => 'Najmuddin',
            'last_name' => 'Razali'
        ], [
            'email' => 'najmuddin@gmail.com',
            'password' => 'Password@1'
        ]);

        User::firstOrCreate([
            'first_name' => 'Alex Goh',
            'last_name' => 'Kean Tiong'
        ], [
            'email' => 'alex@gmail.com',
            'password' => 'Password@2'
        ]);

        User::firstOrCreate([
            'first_name' => 'Faizuddin',
            'last_name' => 'Azman'
        ], [
            'email' => 'faizuddin@gmail.com',
            'password' => 'Password@3'
        ]);

        User::firstOrCreate([
            'first_name' => 'Amirul',
            'last_name' => 'Zakariah'
        ], [
            'email' => 'amirul@gmail.com',
            'password' => 'Password@4'
        ]);
    }
}
