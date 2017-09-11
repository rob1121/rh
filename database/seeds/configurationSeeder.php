<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class configurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurations')->truncate();

        factory(App\Configuration::class)->create();
    }
}
