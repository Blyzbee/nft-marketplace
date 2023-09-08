<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Créer 5 utilisateurs de test
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'email' => 'user' . $i . '@example.com',
                'password' => Hash::make('password'),
                'wallet' => 10.0,
            ]);
        }
    }
}
