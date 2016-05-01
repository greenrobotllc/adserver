<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AdzoneController;
use DB;
use App\AdSlotsConfig;
use Exception;
use App\AdProviderConfig;
use App\IncomeReport;
use App\RpmReport;
use App\GeographicReport;


class AdInfoController extends Controller
{


  private $access_token_data_setter; //database access

    public function refresh()
    {
      $asi = new TimeZoneController;
        $timezone = $asi->show();
        date_default_timezone_set($timezone);
        \Config::set('app.timezone', $timezone);

        
      // ini_set('memory_limit', '2048M');//memory hack
      ini_set('max_execution_time', 3000);//execution hack
      session()->forget('access_token');
      $lsm_config = \App\AdProviderConfig::where('type','=','lsm')->value('config');
      $arr = unserialize($lsm_config);
      $adsense_access_token = \App\AdProviderConfig::where('type','=','adsense_access_token')->value('config');
      
      if ($adsense_access_token)
      {
        session(['access_token'=>$adsense_access_token]);
      }

      $adsense_config = \App\AdProviderConfig::where('type','=','adsense')->value('config');
      $lsm_output="";
      $lsm_output = AdInfoController::lsm_update($arr['email'], $arr['pass']); // set this from YOURWEBSITE/admin
      $adsense_output = AdInfoController::adsense_update($adsense_config); // set this from YOURWEBSITE/admin
      // $ads_output = AdInfoController::adslots_update();
      $ads_map_update = new AdzoneController(false);
      $ads_output = $ads_map_update->WeightageCalculator();

      return $lsm_output.$adsense_output.$ads_output;
    }
    
    private function saveAccessToken($token)
    {
        $access_token_data_setter = \App\AdProviderConfig::firstOrNew(array('type'=>'adsense_access_token','user_id'=>\Auth::id()));
        $access_token_data_setter->config = $token;
        $access_token_data_setter->save();
    }

    public function deleteAccessToken()
    {
            session()->forget('access_token');

        $access_token_data_setter = AdProviderConfig::where('type','adsense_access_token')->where('user_id',\Auth::id())->delete();
    }


    private function lsm_update($user, $pass) 
    {
      $income = 0;
      $output = "<p>.:: Processing LifeStreet Media ::. <br />";

     if (!$user && !$pass)
      {
        $output .= "!! PLEASE ADD YOUR LSM ACCOUNT DETAILS !! <br /><hr>";
        return $output;
      }

      $url = 'https://my.lifestreetmedia.com/reporting/run/';
      $params = array(
          'measurements' => array('adImps', 'adCost'),
          'dimensions' => array('Date','Country.name'),
          'date_range' => 'today',
      );

      $ch = curl_init();
      curl_setopt( $ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
      curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt ($ch, CURLOPT_URL, $url);
      curl_setopt ($ch, CURLOPT_USERPWD, $user . ':' . $pass);
      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
      if (!empty($params)) {
      	curl_setopt ($ch, CURLOPT_POST, 1);
      	curl_setopt ($ch, CURLOPT_POSTFIELDS, array('data' => json_encode($params)));
      }
      // $or = curl_exec($ch);
      $response = json_decode(curl_exec($ch), true);
      // error_log(print_r($response, true));
      curl_close($ch);
      if(is_array($response) && array_key_exists('error', $response) && $response['error'] === false) {

        $output .= "Got LSM results<br />";
        $getAdImp = 0;
        $getAdCost = 0;

        foreach ($response['data'] as $key => $value) {
          $getAdImp += $value['adImps'];
          $getAdCost += $value['adCost'];
          if ($value['adImps'] == 0)
          {
            $cva = 0;
          }else{
            $cva = $value['adCost'] / $value['adImps'];
          }
          $this::addgeographic($value['Country.name'],$value['adCost'],round(($cva)*1000, 3), 'lsm');
        }
        // $data = array_pop($response['data']);
        $adImpsM = $getAdImp / 1000;
        $income = $getAdCost;
        $rpm = round($getAdCost / $adImpsM, 3);
        // $output.="\n Today Income: ".$income;
      }

      if(is_array($response) && array_key_exists('error', $response) && $response['error'] === true) {
        $output .= $response['message'] . "<br />";
        if (strcmp($response['message'], "Reporting service returned no data.") === 0)
            $rpm = 0;
      }

      if (isset($rpm))
      {
        $output .= "LSM RPM: ".$rpm."<br />";

        DB::table('ads')->where('id', 2)->update([
          'last_rpm' => $rpm,
          'updated_at' => date("Y-m-d H:i:s")
        ]);

        //add income to lsm entry
        $this::addIncome('lsm',$income);
        $this::addRpm('lsm',$rpm);

        $output .= "Updated Database with LSM RPM<br />";
      }else{
        $output .= "Unable to Proceed <br />";
      }

      $output .= "LifeStreet Media Processing Done</p><hr>";
      return $output;
    }

    private function adsense_update($account_id) 
    {

      $output = ".:: Processing Adsense ::. <br />";

      if (!$account_id)
      {
        $output .= "!! PLEASE ADD YOUR ADSENSE ACCOUNT ID OR PUBLISHER ID !!<hr>";
        return $output;
      }


      $client = new \Google_Client();
      $client->addScope('https://www.googleapis.com/auth/adsense.readonly');
      $client->setAccessType('offline');
      $client->setApprovalPrompt('force');
      $client->setAuthConfigFile(config_path().'/google_client_secrets.json');
      // $client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/adserver/public/adinfo_refresh');

      if (isset($_GET['code']) && !session('access_token')) {
     $client->authenticate($_GET['code']);
     $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
      header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
     session(['access_token'=>$client->getAccessToken()]); 
     AdInfoController::saveAccessToken(session("access_token"));
     $output .= "Done";
      }
      //ya29.rQI2GR2_7uKr0b4tHhsXg-j-66sLb4uUAgPXUROiW7gQCenmjc7ymDBOT7DgLeZYAg
      //1/Iyh1ocDfRQQhyR0zz2xzFzEhfAqqdWr60BCGES5oYWE
      // $client->revokeToken("ya29.rQI2GR2_7uKr0b4tHhsXg-j-66sLb4uUAgPXUROiW7gQCenmjc7ymDBOT7DgLeZYAg");
      if (isset($_GET['code']))
      {
          return  \Redirect::to('refresh');
      }

          if (session('access_token')) {
            $client->setAccessToken(session('access_token'));
            $refresh_token = json_decode(session('access_token'))->refresh_token;
          } else {
            $authUrl = $client->createAuthUrl();
          }

            if ($client->getAccessToken()) {
                   session(['access_token'=>$client->getAccessToken()]);
                   $refresh_token = json_decode(session('access_token'))->refresh_token;
            }

            if (isset($authUrl)) {
              $output .= "<a class='login' href='" . $authUrl . "'>Google Login IN to Confirm Your Account</a><br />"; 
              } 

      $service = new \Google_Service_AdSense($client);

      // $client->setAccessToken($google_access_token);

      if ($client->getAccessToken()) {

        $optParams = array(
          'metric' => array('AD_REQUESTS_RPM','EARNINGS'),
          'dimension'=>array('COUNTRY_NAME'),
        );
        try{
        $report = $service->accounts_reports->generate($account_id, 'today', 'today', $optParams);
      }catch(Exception $e)
      {
        error_log($e->getMessage());

        //now using refresh token here
        try{
          $client->refreshToken($refresh_token);
          session(['access_token'=>$client->getAccessToken()]);
          AdInfoController::saveAccessToken(session("access_token"));
        }catch(Exception $e)
        {
          error_log($e->getMessage());
          //all things are done now we need to re-authenticate
          //An Token Error Occured
          $this::deleteAccessToken();
        }

       // Authentication Needs to Refreshed
       return \Redirect::to('refresh');
      }
        if(isset($report)) {
          $output .= "Got AdSense results<br />";
          // error_log(print_r($report,true));
          // print_r($report);
          if (isset($report['rows']) && array_key_exists(0, $report['rows'])) {
            foreach ($report['rows'] as $key => $value) {
                $this::addgeographic($value[0],$value[2], $value[1], 'adsense');
            }
            $rpm = $report['totals'][1];
            $income = $report['totals'][2];
          } else {
            $rpm = 0;
            $income = 0;
          }

          $output .= "AdSense RPM: ".$rpm."<br />";
          $output .= "AdSense Income: ".$income."<br />";

          DB::table('ads')->where('id', 1)->update([
            'last_rpm' => $rpm,
            'updated_at' => date("Y-m-d H:i:s")
          ]);
          $this::addIncome('adsense',$income);
          $this::addRpm('adsense',$rpm);
          $output .= "Updated Database with AdSense RPM<br />";
        }

      }
              $output .= "AdSense Processing Done</p><hr>";

      return $output;
    }

    private function addIncome($type,$income)
    {
        $date = Date('Y-m-d');
        $db = IncomeReport::firstOrNew(['type'=>$type,'date'=>$date]);
        $db->income = $income;
        $db->save();
    }
    private function addRpm($type, $rpm)
    {
        $date = Date('Y-m-d');
        $db = RpmReport::firstOrNew(['type'=>$type,'date'=>$date]);
        $db->rpm = $rpm;
        $db->save();
    }
    private function addgeographic($country,$adcost,$adimp, $type)
    {
      $date = Date('Y-m-d');
      $db = GeographicReport::firstOrNew(['type'=>$type,'date'=>$date,'country'=>$country]);
      $db->impressions = $adimp;
      $db->cost = $adcost;
      $db->save();
    }
}