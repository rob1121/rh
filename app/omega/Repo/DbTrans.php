<?php namespace App\omega\Repo;

use App\omega\models\device;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class DbTrans
{
    use ValidatesRequests;

    protected $request;
    protected $device;

    public function __construct(Request $request = null)
    {
        $this->request = $request;
    }

    public function validateRequest($device = null)
    {
        $this->device = $device;
        $rule = 'required|unique:devices,ip';

        if($device != NULL) $rule .= ',' . $device->id;

        $this->validate($this->request, [
            'ip' => $rule,
            'location' => 'required'
        ]);

        //check if its ajax request
        if ($this->request->ajax()) return $this;

    }

    public function store()
    {
        return device::create($this->request->all());
    }

    public function update()
    {
        $collection = new device($this->request->all());

        $this->device->update($collection->toArray());

    }
}