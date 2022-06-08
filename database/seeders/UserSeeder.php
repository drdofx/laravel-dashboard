<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'daffa',
            'email' => 'daffaonavi@gmail.com',
            'password' => Hash::make('12345678'),
            'admin' => true
        ]);
    }
}
