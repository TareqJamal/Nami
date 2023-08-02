<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models;

class admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::create([
           'name'=>'tareq',
           'email'=>'admin@gmail.com',
           'password'=> Hash::make('12345678'),
           'phone'=>'01204638849',
           'image'=>'admin_images/tareq.jpg'
       ]);

    }
}
