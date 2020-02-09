<?php

namespace App\Http\Controllers;

use App\Otherads;
use App\User;
use Exception;
// use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    /**
     * Responsible for other ads management & API.
     *
     * @param  int  $id
     * @return Response
     */
    private $appkey;
    private $appsecret;
    private $token;


    public function __construct()
    {
        $key = \App\User::get()->first();
        $this->token = md5($key->created_at."token");
    }
    private function getToken()
    {
        return $this->token;
    }

    public function verifyH()
    {            
        $app = \Input::get('appkey');
        $secret = \Input::get('appsecret');

        $slug = \Input::get('addkey');
        $value = \Input::get('value');
        $token = \Input::get('token');

        if (\Input::has('token')) {
            if ($this->token != $token) {
                return $this::showError();
            }
            switch (\Input::get('action')) {
            case 'generate':
                return $this::displayappkey();
                break;
            case 'verify':
                return $this::verify($app, $secret);
                break;    
            case 'rpm':
                return $this::update_rpm($slug, $value);
                break;
            
            default:
                return response()->json(['error' => "Invalid API Request"], 400);
                break;
            }
        }
        return ApiController::verify($app, $secret);
    }

    public function verify($app,$secret)
    {
        //As One User per system so no need to authenticate or go to any other user
        $key = \App\User::get()->first();
        $data = $key->created_at;
        $responseMessage = null;
        $responseCode = null;

        if (md5($data) == $app && \Hash::check($data,  $secret)) {
            session(['verified_app_key'=>md5($data)]);
            $responseMessage = ['success' => "API Credentials Verified",'token'=> $this->token];
            $responseCode = 200;
        }else{
            session()->forget('verified_app_key');
            $responseMessage = ['error' => "Invalid API Credentials"];
            $responseCode = 403;
        }
        return response()->json($responseMessage, $responseCode);
    }
    private function generateappkey()
    {
        //As One User per system so no need to authenticate or go to any other user
        $key = \App\User::get()->first();
        ApiController::setappkey(md5($key->created_at));
        ApiController::setappsecret(\Hash::make($key->created_at));
        return true;
    }

    public function displayappkey()
    {
        ApiController::generateappkey();
        $credentials = array('app_key' => $this->appkey,'app_secret'=>$this->appsecret);
        return response()->json(['api' => $credentials], 200);
    }

    private function setappkey($key)
    {
        $this->appkey = $key;
    }
    private function setappsecret($key)
    {
        $this->appsecret = $key;
    }

    public function clientview()
    {
        ApiController::generateappkey();
        $token = $this->token;
        return \View::make('api', ['page'=>'api','public'=>$this->appkey, 'secret'=>$this->appsecret, 'token'=>$token]);
    }

    private function update_rpm($slug, $value)
    {
        $responseCode = 200;
        $responseMessage = ['success' => "RPM VALUE UPDATED"];;

        if (!is_numeric($value)) {
            $responseCode = 400;
            $responseMessage=['error' => "Invalid API Request"];
            return response()->json($responseMessage, $responseCode);
        }
        try{
            $entry = \App\CustomAdd::where('slug', '=', $slug)->first();
            $entry->rpm = $value;

            $entry->save();
        }catch (\Exception $e)
        {
            $responseCode = 400;
            $responseMessage=['error' => "Invalid API Request"];
        }
        return response()->json($responseMessage, $responseCode);
    }

    private function showError()
    {
        $responseMessage = ['error' => "Invalid API Token"];
        $responseCode = 403;
        return response()->json($responseMessage, $responseCode);

    }
    private function addRpm($type, $rpm, $relation)
    {
        $date = Date('Y-m-d');
        $db = RpmReport::firstOrNew(['type'=>$type,'date'=>$date, 'relation'=>$relation]);
        $db->rpm = $rpm;
        $db->save();
    }

}