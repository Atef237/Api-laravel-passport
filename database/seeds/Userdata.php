<?php

use Illuminate\Database\Seeder;

class Userdata extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\User::class, 20)->create();
    }
}
