<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(deviceSeeder::class);
        $this->call(userSeeder::class);
        $this->call(configurationSeeder::class);
    }
}
