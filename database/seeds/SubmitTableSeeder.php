<?php

use Illuminate\Database\Seeder;

class SubmitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Submit::class, 5)->create();
    }
}
