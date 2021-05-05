<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Yashraj Patel',
            'email' => 'yashpatel8810@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('987654321'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
