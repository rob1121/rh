<?php namespace App\omega\Repo;

use App\omega\models\device;
use App\omega\Traits\DateTime;
use DB;
use Excel;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class DbTrans
{
    use DateTime;
    use ValidatesRequests;
    protected $request;
    protected $isExist;

    public function __construct(Request $request = null)
    {
        $this->request = $request;
    }

    public function store()
    {
        return device::create($this->request->all());
    }

    public function validateRequest()
    {
        $this->validate($this->request, [
            'ip' => 'required|unique:devices,ip',
            'location' => 'required'
        ]);

        if ($this->request->ajax()) return;

        return $this;
    }
}