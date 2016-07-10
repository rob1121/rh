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
        $this->call(userSeeder::class);
        $this->command->info('users table seeded!');
		$this->call(omegaListSeeder::class);
		$this->command->info('omegas table seeded!');
    }
}
