<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        
        User::create([
            'username' => 'admin',
            'password' => bcrypt('rh-admin'),
            'email' => 'jakeparambita@astigp.com',
            'name' => 'J. Parambita'
        ]);
    }
}
