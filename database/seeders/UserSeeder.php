<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        User::factory(5)->create();

        User::create([
            'name' => 'Oleg Shvets',
            'email' => config('app.dev_email'),
            'role' => 'developer',
            'password' => Hash::make(config('app.dev_password')),
        ]);
    }
}
