<?php

use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->truncate();
        factory(App\User::class)->create([
            "employee_id" => 801,
            "email"       => "robinsonlegaspi@astigp.com",
            "password"    => bcrypt("admin"),
            "name"        => "Robinson L. Legaspi",
            "is_admin"    => 1
        ]);

//        factory(App\User::class, 10)->create();
    }
}
