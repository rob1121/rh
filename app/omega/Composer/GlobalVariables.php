<?php namespace App\omega\Composer;

use Illuminate\Contracts\View\View;
use JavaScript;
class GlobalVariables
{
    public function compose(View $view)
    {
        $view->with('server', "/rh-temp/public");
        JavaScript::put('env_server', "/rh-temp/public");
    }
}