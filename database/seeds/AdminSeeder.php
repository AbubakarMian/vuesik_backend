<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
        
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'username' => 'admin',
            'dob' => '2020-12-16',
            'email' => 'admin@mail.com',
            'role_id' => '1',
            'password' => Hash::make('abc123')
        ]); 
    }
}
