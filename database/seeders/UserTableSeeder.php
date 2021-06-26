<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
            'nama_lengkap' => 'admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('admin'),
            'is_admin' => 'ya'
        ]);
    }
}
