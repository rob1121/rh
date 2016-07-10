<?php namespace App\omega\Composer;

use Illuminate\Contracts\View\View;
use JavaScript;

class GlobalVariables
{
    public function compose(View $view)
    {
        $server = "";
        $server = "/rh-temp/public";

        $view->with('server', $server);
        JavaScript::put('env_server', $server);
    }
}