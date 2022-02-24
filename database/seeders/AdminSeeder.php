<?php

namespace Database\Seeders;

use App\Models\Admin;
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
        $admin = Admin::create([
            'name' => 'HT PHO DAT VIET',
            'gender' => 'MALE',
            'phone' => '+7 (900) 555 67 89',
            'email' => 'mail@htphodatviet.com',
            'password' => Hash::make('123456789'),
            'image' => 'avatar_default.png',
        ]);
    }
}
