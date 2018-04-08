<?php

use Illuminate\Database\Seeder;

class QuestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Quest::create([
            'user_id' => 1,
            'name' => 'Spirituality',
            'description' => 'To become more connected with the inner self',
        ]);

        App\Quest::create([
            'user_id' => 1,
            'name' => 'Phisical Form',
            'description' => 'Just be healthy and shit, jesus christ',
        ]);

        App\Quest::create([
            'user_id' => 1,
            'name' => 'Creativity',
            'description' => 'Just be healthy and shit, jesus christ',
        ]);

        App\Quest::create([
            'user_id' => 1,
            'name' => 'Professional Growth',
            'description' => 'In my case, code some shit and we\'ll see',
        ]);

        App\Quest::create([
            'user_id' => 1,
            'name' => 'Mind Expansion',
            'description' => 'read',
        ]);

        App\Quest::create([
            'user_id' => 1,
            'name' => 'Social Life',
            'description' => 'read',
        ]);
    }
}
