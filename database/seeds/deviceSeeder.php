<?php

use Illuminate\Database\Seeder;

class deviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $devices = [
        ["ip" => "192.168.1.181",	"position" => 1, "location" => "TNR L-2"],
        ["ip" => "192.168.1.182",	"position" => 2, "location" => "TNR L-6"],
        ["ip" => "192.168.1.183",	"position" => 3, "location" => "RTO 1"],
        ["ip" => "192.168.1.184",	"position" => 4, "location" => "RTO 2"],
        ["ip" => "192.168.1.185",	"position" => 5, "location" => "QFP L-2"],
        ["ip" => "192.168.1.186",	"position" => 6, "location" => "FVI |OQA"],
        ["ip" => "192.168.1.187",	"position" => 7, "location" => "IQA TRAY BASED"],
        ["ip" => "192.168.1.188",	"position" => 8, "location" => "IQA STD"],
        ["ip" => "192.168.1.189",	"position" => 9, "location" => "TNR L-1"],
        ["ip" => "192.168.1.190",	"position" => 10, "location" => "TNR L-4A"],
        ["ip" => "192.168.1.191",	"position" => 11, "location" => "TNR L-4B"],
        ["ip" => "192.168.1.192",	"position" => 12, "location" => "PAINT AND REMARKS"],
        ["ip" => "192.168.1.193",	"position" => 13, "location" => "PL3 Batching"],
        ["ip" => "192.168.1.194",	"position" => 14, "location" => "PL3 Boxing"],
        ["ip" => "192.168.1.195",	"position" => 15, "location" => "PL3 Production"],
        ["ip" => "192.168.1.196",	"position" => 16, "location" => "BOXING"],
        ["ip" => "192.168.1.197",	"position" => 17, "location" => "TRAFFIC"],
        ["ip" => "192.168.1.201",	"position" => 18, "location" => "QFP L-1"],
        ["ip" => "192.168.1.198",	"position" => 19, "location" => "MEMs1(left)"],
        ["ip" => "192.168.1.202",	"position" => 20, "location" => "MEMs2(right)"],
        ["ip" => "192.168.1.199",	"position" => 21, "location" => "MEMs3 (left)"],
        ["ip" => "192.168.1.203",	"position" => 22, "location" => "MEMS RES"]
    ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('devices')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        foreach ($devices as $device)
            factory(App\Monitor::class, rand(5, 10))->create([
                "device_id" => factory(App\Device::class)->create($device)->id
            ]);
    }
}
