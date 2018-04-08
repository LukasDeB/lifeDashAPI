<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Admin Istrator',
            'email' => 'admin@lifedash.pt',
            'password' => Hash::make('admin'),
        ]);
    }
}
