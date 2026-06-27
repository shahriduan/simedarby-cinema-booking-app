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
            'password' => 'najmuddin@1'
        ]);

        User::firstOrCreate([
            'first_name' => 'Alex Goh',
            'last_name' => 'Kean Tiong'
        ], [
            'email' => 'alex@gmail.com',
            'password' => 'alex@2'
        ]);
    }
}
