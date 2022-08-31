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
            "user_id"=> 1,
            "studentID"=>1,
            "first_name"=> "dyna",
            "last_name"=>"khorn",
            "gender"=> "male",
<<<<<<< HEAD
            "email"=> "sreyleak.student@gmail.com",
            "password" => Hash::make("1234ewq"),
=======
            "email"=> "sreyleak.el@student.passerellesnumeriques.org",
            "password" => Hash::make("12345678"),
>>>>>>> 17b1549a707dca4771c07f339a0220137251d162
            "class" => "2022WEB-A",
            "phone" => "077932529",
            "batch"=> '2022',
            "image"=> 'image'
        ];
        Student::create($student);
    }
}