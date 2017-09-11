<?php namespace App\Http\Controllers;

class DeviceController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
//        $this->sendSMSNofitication();
        return view('device.index');
    }

    protected function itexmo($number,$message,$apicode){
        $url = 'https://www.itexmo.com/php_api/api.php';
        $itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
        $param = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($itexmo),
            ),
        );
        $context  = stream_context_create($param);
        return file_get_contents($url, false, $context);
    }

    protected function sendSMSNofitication()
    {
        $result = $this->itexmo("09232984610", "Test Message", "ROBIN984610_WNLUH");
        if ($result == "") {
            echo "iTexMo: No response from server!!!
                Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
                Please CONTACT US for help. ";
        } else if ($result == 0) {
            echo "Message Sent!";
        } else {
            echo "Error Num " . $result . " was encountered!";
        }
    }
}
