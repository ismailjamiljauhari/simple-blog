<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

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
            'name' => 'Author',
            'email' => 'author@gmail.com',
            'password' => \Hash::make('author123'),
            'profile' => 'Author test',
        ]);
    }
}
