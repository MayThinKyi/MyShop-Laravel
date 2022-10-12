<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
         User::create([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'phone'=>'09448998082',
            'address'=>'Yangon',
            'gender'=>'male',
            'role'=>'admin',
            'password'=>Hash::make('adminpassword')
        ]);
    }
}