<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student = [
            "first_name"=> "dyna",
            "last_name"=>"khorn",
            "gender"=> "male",
            "email"=> "sreyleakel.official@gmail.com",
            "password" => Hash::make("1234ewq"),
            "class" => "2022WEB-A",
            "generation"=> 2022,
            "image"=> 'image'
        ];
        Student::create($student);
    }
}
