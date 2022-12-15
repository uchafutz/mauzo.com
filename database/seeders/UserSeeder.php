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
     *
     * @return void
     */
    public function run()
    {
        //
        User::factory()->create(
            [
                "email" => "markmayalla@gmail.com",
                "password" => Hash::make("mark@123")
            ]
        );
        User::factory()->create(
            [
                "email" => "yona@gmail.com",
                "password" => Hash::make("yona@123")
            ]
        );
    }
}