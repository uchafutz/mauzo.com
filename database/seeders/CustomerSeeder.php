<?php

namespace Database\Seeders;

use App\Models\Customer\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::firstOrCreate(
            [

                'name' => 'Default Customer',
                'email' => 'john@example.com',
                'phone' => '068290104',
                'address' => '123 Main Street',
            ]


        );
        //
    }
}