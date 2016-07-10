<?php
use App\omega\models\device;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class omegaListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('statuses')->delete();
		DB::table('devices')->delete();

		$collections = [
			['ip' => '192.168.1.181', 'location' => 'TNR L-2 '],
			['ip' => '192.168.1.182', 'location' => 'TNR L-6 '],
			['ip' => '192.168.1.183', 'location' => 'RTO 1'],
			['ip' => '192.168.1.184', 'location' => 'RTO 2'],
			['ip' => '192.168.1.185', 'location' => 'QFP L-2'],
			['ip' => '192.168.1.186', 'location' => 'FVI |OQA'],
			['ip' => '192.168.1.187', 'location' => 'IQA TRAY BASED'],
			['ip' => '192.168.1.188', 'location' => 'IQA STD'],
			['ip' => '192.168.1.189', 'location' => 'TNR L-1'],
			['ip' => '192.168.1.190', 'location' => 'TNR L-4A'],
			['ip' => '192.168.1.191', 'location' => 'TNR L-4B'],
			['ip' => '192.168.1.192', 'location' => 'PAINT AND REMARKS'],
			['ip' => '192.168.1.193', 'location' => 'PL3 Batching'],
			['ip' => '192.168.1.194', 'location' => 'PL3 Boxing'],
			['ip' => '192.168.1.195', 'location' => 'PL3 Production'],
			['ip' => '192.168.1.196', 'location' => 'PAINT AND REMARKS'],
			['ip' => '192.168.1.197', 'location' => 'BOXING'],
			['ip' => '192.168.1.201', 'location' => 'QFP L-1'],
			['ip' => '192.168.1.198', 'location' => 'MEMs1(left)'],
			['ip' => '192.168.1.202', 'location' => 'MEMs2(right)'],
			['ip' => '192.168.1.199', 'location' => 'MEMs3 (left)']
		];

    	foreach ($collections as $collection) {
			$device = device::create([
				'ip' => $collection['ip'],
				'location' => $collection['location']
			]);

//    		$device->status()->create([
//                'rh' => 'Offline',
//                'temp' => 'Offline'
//    		]);
    	}
    }
}


