<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $user= [
            'first_name' => 'Sim',
            'last_name' => 'Hul',
            'gender' => 'male',
            'email' => 'socialaffairadmin@passerellesnumeriques.org',
            'password' => Hash::make('pnc2022'),
            'position' => 'Social Affair Team Leader',
            'image' => 'image'
        ];
        User::create($user);
    }
}
