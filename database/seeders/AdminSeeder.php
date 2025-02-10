<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin =new Admin();
        $admin->image='/dummystring';
        $admin->name='Erfan';
        $admin->email='hi@gmail.com';
        //Hash::make('password');
        $admin->password=encrypt("salam");
        $admin->status=1;
        $admin->save();

    }
}
