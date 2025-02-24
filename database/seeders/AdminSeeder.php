<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@example.com', // แก้ไขให้เป็นอีเมลที่คุณต้องการ
            'password' => Hash::make('123456789'), // กำหนดรหัสผ่านที่ต้องการ
            'role' => 'admin',
        ]);
    }
}
