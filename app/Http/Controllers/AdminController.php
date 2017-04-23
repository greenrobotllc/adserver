<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\AdSlotsConfig;
use Exception;
/**
     * Responsible for all Commands used in Admin
     * functions
     * showhome
     * saveAdsense
     * saveLSM
     * show Login
     * dologin
     * dologout
     * refresh
     * LSMAdConfig
     * AdsenseAdConfig
     * UpdateAdsenseCode
     * UpdateLSMCode
     * LSMHeadParser
     * LSMCodeParser
     * SaveAdsenseUnmodified
     * SaveLSMUnmodified
     * LSMAdCompare
     * AdsenseAdCompare
     * addOtherAdd
*/

class AdminController extends Controller
{
	/**
     * Show the home page for admin panel.
     *
     * @return \Illuminate\Http\Response
     */
	public function showhome()
	{
		// $location = \GeoIP::getLocation();
		// print_r($location);
		// exit;
		if (!\Auth::check())
		{
			return \Redirect::to('login');
		}
		$lsm_rpm = DB::table('ads')->where('id', 2)->first();
		$adsense_rpm = DB::table('ads')->where('id',1)->first();
		$mopub_rpm = DB::table('ads')->where('id', 3)->first();
		$lsm_email = $lsm_password = "";
		//Get Configrations
		$configs = \App\AdProviderConfig::where('type','=','lsm')->where('user_id','=',\Auth::user()->id)->value('config');
		if ($configs)
		{
			$config_array = unserialize($configs);
			$lsm_email = $config_array['email'];
			$lsm_password = $config_array['pass'];
		}

		$adsense_pub = \App\AdProviderConfig::where('type','=','adsense')->where('user_id','=',\Auth::user()->id)->value('config');

		$my_slot_id = DB::table('ad_slots')->where('user_id','=',\Auth::user()->id)->value('id');
		if(!$my_slot_id)
		{
			 $my_slot_id = 1;
		}
		// $timezone_set = TimeZoneController::isTimeZoneSet();
		$custom_add  = \App\CustomAdd::orderBy('rpm', 'desc')->take(10)->get();
		$mopub_api_key="MoPub API Key";
		$mopub_report_id="MoPub Report ID";
		
		$configs = \App\AdProviderConfig::where('type','=','mopub')->where('user_id','=',\Auth::user()->id)->value('config');
		if ($configs)
		{
			$config_array = unserialize($configs);
			$mopub_api_key = $config_array['api_key'];
			$mopub_report_id = $config_array['report_id'];
		}
		
		return \View::make('home',[
			'ad_slot_id'=>$my_slot_id,
			'adsense_pub'=>$adsense_pub,
			'mopub_api_key'=>$mopub_api_key,
			'mopub_report_id'=>$mopub_report_id,
			'lsm_pass'=>$lsm_password,
			'lsm_email'=>$lsm_email,
			'lsm_rpm'=>$lsm_rpm, 
			'adsense_rpm'=>$adsense_rpm,
			'custom_add' => $custom_add,
			'mopub_rpm' => $mopub_rpm,
			// 'timezone_set' => $timezone_set,
			'page'=>'home']);
	}
	/**
     * This save Adsense Code.
     *
     * @return Redirect to showhome()
     */
	public function saveAdsense()
	{
		$input = \Input::get('adsense_pub');
		$data = \App\AdProviderConfig::firstOrNew(array('type'=>'adsense','user_id'=>\Auth::id()));
		$data->config = \Input::get('adsense_pub');
		$data->save();
		return \Redirect::to('admin');
	}
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function saveLSM()
	{
		$arr = array('email' => \Input::get('lsm_email'), 'pass'=>\Input::get('lsm_pass'));
		$input = serialize($arr);
		$data = \App\AdProviderConfig::firstOrNew(array('type'=>'lsm','user_id'=>\Auth::id()));
		$data->config = $input;
		$data->save();
		return \Redirect::to('admin');
	}
	

	public function saveMopub()
	{
		$arr = array('api_key' => \Input::get('mopub_api_key'), 'report_id'=>\Input::get('mopub_report_id'));
		$input = serialize($arr);
		$data = \App\AdProviderConfig::firstOrNew(array('type'=>'mopub','user_id'=>\Auth::id()));
		$data->config = $input;
		$data->save();
		return \Redirect::to('admin');
	}
	
	
	/**
     * Show the login form for login process.
     *
     * @return \Illuminate\Http\Response
     */
	public function showlogin()
	{
		if (\Auth::check())
		{
			return \Redirect::to('admin');
		}
		return \View::make('auth.login');
	}
	/**
     * Receive login information and process it by validation.
     *
     * @return redirect to login or homepage
     */
	public function dologin()
	{
		if (\Auth::check())
		{
			return \Redirect::to('\admin');
		}
		// validate the info, create rules for the inputs
		$rules = array(
		    'email'    => 'required|email', // make sure the email is an actual email
		    'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(\Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
		    return \Redirect::to('login')
		        ->withErrors($validator) // send back all errors to the login form
		        ->withInput(\Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {

		    // create our user data for the authentication
		    $userdata = array(
		        'email'     => \Input::get('email'),
		        'password'  => \Input::get('password')
		    );
		    // attempt to do the login
		    if (\Auth::attempt($userdata)) {
		        return \Redirect::to('admin');

		    } else {        
		        return \Redirect::to('login')->withErrors(array('email'=>'Invalid UserName/Password'));

		    }

		}
	}
	/**
     * This is responsible for logout command.
     *
     * @return Redirect to login page
     */
	public function doLogout()
	{
    	\Auth::logout(); // log the user out of our application
    	return \Redirect::to('login'); // redirect the user to the login screen
	}
	/**
     * Responsible for refreshing LSM & Adsense code .
     *
     * @return \Illuminate\Http\Response
     */
	public function refresh()
	{
		if (!\Auth::check())
		{
			return \Redirect::to('login');
		}
		$AdInfo = new AdInfoController();
		$output = $AdInfo->refresh();
		return \View::make('refresh',['output'=>$output,'page'=>'refresh']);
	}
	/**
     * Show LSM code in the form.
     *
     * @return \Illuminate\Http\Response
     */
	public function lsmAdConfig()
	{
		if (!\Auth::check())
		{
			return \Redirect::to('login');
		}
		$unmoded = \App\AdProviderConfig::where('type','=','lsm_ad_code_unmodified')->where('user_id','=',\Auth::user()->id)->value('config');
  		$lsm_unmodified = unserialize($unmoded);
  		$prepareLsmHeader = $lsm_unmodified['head'];
  		$prepareLsmCode = $lsm_unmodified['code'];
		return \View::make('config.lsm',['page'=>'lsm-ad-config', 'header'=>$prepareLsmHeader, 'code'=>$prepareLsmCode]);
	}
	/**
     * Show Adsense Code in the form.
     *
     * @return \Illuminate\Http\Response
     */
	public function adsenseAdConfig()
	{
		if (!\Auth::check())
		{
			return \Redirect::to('login');
		}
		$prepareAdSenseCode = "";
		$prepareAdSenseCode = \App\AdProviderConfig::where('type','=','adsense_ad_code_unmodified')->where('user_id','=',\Auth::user()->id)->value('config');
		return \View::make('config.adsense',['page'=>'adsense-ad-config','code'=>$prepareAdSenseCode]);
	}
	/**
     * Update Adsense Ad Code in Database.
     *
     * @return \Illuminate\Http\Response
     */
	public function updateAdsenseAdCode()
	{
		if (!\Auth::check())
		{
			return \Redirect::to('login');
		}
		$code = \Input::get('adsense_code');
		if (empty($code))
		{
			return \Redirect::to('adsense-ad-config')->withErrors(array('error'=>'Please paste Valid Adsense Code'));
		}
		$parse = new \DOMDocument();
		$parse->loadHTML($code);

		if (!$parse)
		{
			return \Redirect::to('adsense-ad-config')->withErrors(array('error'=>'Please paste Valid Adsense Code'));
		}
		//Some Serious Adsense Code Validation
		foreach ($parse->getElementsByTagName('ins') as $item):
			$adclient = $item->getAttribute('data-ad-client');
			$style = $item->getAttribute('style');
			$adslot = $item->getAttribute('data-ad-slot');
			break;
		endforeach;
		AdminController::saveAdsenseCodeUnmodified($code);
		//for validation save the extracted information whcih is not required as we are saving original input from client
		$data = \App\AdProviderConfig::firstOrNew(array('type'=>'adsense_ad_code','user_id'=>\Auth::id()));
		$config_received = array('adclient' => $adclient, 'style'=>$style, 'adslot'=>$adslot);
		$config = serialize($config_received);
		$data->config = $config;
		$data->save();
		//now redirect ot original page
		return \Redirect::to('adsense-ad-config');
	}
	/**
     * Update the LSM Ad Code in database.
     *
     * @return \Illuminate\Http\Response
     */
	public function updateLsmAdCode()
	{
		$header = \Input::get('lsm_header');
		$code = \Input::get('lsm_code');
		if (empty($header) || empty($code))
		{
			return \Redirect::to('lsm-ad-config')->withErrors(array('error'=>'Please paste Header and JS TAG CODE'));
		}
		$lsm_ad_site = AdminController::lsmHeadParser($header);
		$lsm_code = AdminController::lsmCodeParser($code);
		if (!$lsm_ad_site || !$lsm_code)
		{
			return \Redirect::to('lsm-ad-config')->withErrors(array('error'=>'Invalid Code'));
		}
		AdminController::saveLsmCodeUnmodified($header, $code);
		$lsm_ad_key = $lsm_code['lsm_ad_key'];
		$lsm_ad_size = $lsm_code['lsm_ad_size'];
		$lsm_ad_slot = $lsm_code['lsm_ad_slot'];

		$data = \App\AdProviderConfig::firstOrNew(array('type'=>'lsm_ad_code','user_id'=>\Auth::id()));
		$config_array = array('ad_site' => $lsm_ad_site, 'ad_key'=>$lsm_ad_key, 'ad_size'=>$lsm_ad_size, 'ad_slot'=>$lsm_ad_slot);
		$config = serialize($config_array);
		$data->config = $config;
		$data->save();
		return \Redirect::to('lsm-ad-config');
	}
	/**
     * Parse LSM Head Code for validation standards.
     *
     * @return \Illuminate\Http\Response
     */

	public function lsmHeadParser($header)
	{
		$parse = new \DOMDocument();
		$parse->loadHTML($header);
		if (!$parse)
		{
			 \Redirect::to('lsm-ad-config')->withErrors(array('error'=>'Invalid Header'));
			 return null;
		}
		foreach ($parse->getElementsByTagName('script') as $item):
			$src = $item->getAttribute('src');
			break;
		endforeach;
		if (!$src)
		{
			 \Redirect::to('lsm-ad-config')->withErrors(array('error'=>'Invalid Header'));
			 return null;
		}
		$parts = parse_url($src);
		parse_str($parts['query'], $query);
		return $query['site'];
	}
	/**
     * Parse LSM Code for validation standards.
     *
     * @return \Illuminate\Http\Response
     */
	public function lsmCodeParser($code)
	{
		$code_parse = new \DOMDocument();
		$code_parse->loadHTML($code);
		if (!$code_parse)
		{
			return \Redirect::to('lsm-ad-config')->withErrors(array('error'=>'Invalid JS TAG CODE'));
		}
		foreach ($code_parse->getElementsByTagName('script') as $value) {
			$string =  $value->nodeValue;
		}
		$byass = explode(':', $string);
		if (!$byass || count($byass) < 4)
		{
		 	\Redirect::to('lsm-ad-config')->withErrors(array('error'=>'Invalid JS TAG CODE'));
		 	return null;  	
		}
		//////////////////////
		$adkeyarray = explode('\'', $byass[1]); //adkey
		$lsm_ad_key = $adkeyarray[1];
		if (!$lsm_ad_key)
		{
			 \Redirect::to('lsm-ad-config')->withErrors(array('error'=>'Invalid JS TAG CODE'));
			 return null;
		}
		///////////////////
		$adsizearray = explode('\'', $byass[2]); //adsize
		$lsm_ad_size = $adsizearray[1];
		if (!$lsm_ad_size)
		{
			 \Redirect::to('lsm-ad-config')->withErrors(array('error'=>'Invalid JS TAG CODE'));
			 return null;
		}
		///////////////////
		$slotarray = explode('\'', $byass[3]); //slot
		$lsm_ad_slot = $slotarray[1];
		if (!$lsm_ad_slot)
		{
			\Redirect::to('lsm-ad-config')->withErrors(array('error'=>'Invalid JS TAG CODE'));
			return null;
		}
		////////////////////////////////////////////////////////
		return array('lsm_ad_key'=>$lsm_ad_key, 'lsm_ad_size'=>$lsm_ad_size, 'lsm_ad_slot'=>$lsm_ad_slot);
	}
	/**
     * Save original Adsense Code.
     *
     * @return \Illuminate\Http\Response
     */
	public function saveAdsenseCodeUnmodified($code)
	{
		if (!\Auth::check())
		{
			return \Redirect::to('login');
		}
		$data = \App\AdProviderConfig::firstOrNew(array('type'=>'adsense_ad_code_unmodified','user_id'=>\Auth::id()));
		$config = $code;
		$data->config = $config;
		$data->save();
	}
	/**
     * Save original LSM code.
     *
     * @return \Illuminate\Http\Response
     */
	public function saveLsmCodeUnmodified($head, $code)
	{
		if (!\Auth::check())
		{
			return \Redirect::to('login');
		}
		$data = \App\AdProviderConfig::firstOrNew(array('type'=>'lsm_ad_code_unmodified','user_id'=>\Auth::id()));
		$config_array = array('head'=>$head, 'code'=>$code);
		$config = serialize($config_array);
		$data->config = $config;
		$data->save();
	}
	/**
     * LSM Ad Compare with generated and modified.
     *
     * @return \Illuminate\Http\Response
     */
	public function lsmAdCompare()
	{
		if (!\Auth::check())
		{
			return \Redirect::to('login');
		}
			$lsm_configs = \App\AdProviderConfig::where('type','=','lsm_ad_code')->where('user_id','=',\Auth::user()->id)->value('config');

    	$lsm_config_array = unserialize($lsm_configs);
    	$unmoded = \App\AdProviderConfig::where('type','=','lsm_ad_code_unmodified')->where('user_id','=',\Auth::user()->id)->value('config');
  		$lsm_unmodified = unserialize($unmoded);
  		$contents = \View::make('adjs', ['ad_provider_id' => 2, 'adsense_style'=>"",'adsense_ad_client'=>"",'adsense_ad_slot'=>"",'lsm_site'=>$lsm_config_array['ad_site'],'lsm_ad_key'=>$lsm_config_array['ad_key'],'lsm_ad_size'=>$lsm_config_array['ad_size'],'lsm_ad_slot'=>$lsm_config_array['ad_slot']]);

		return \View::make('lsm.adcompare',['page'=>'lsm-ad-compare', 'lsm'=>$contents, 'lsm_unmodified'=>$lsm_unmodified['head'].$lsm_unmodified['code']]);
	}
	/**
     * Adsense Ad Compare with generated and original.
     *
     * @return \Illuminate\Http\Response
     */
	public function adsenseAdCompare()
	{
		if (!\Auth::check())
		{
			return \Redirect::to('login');
		}
		$adsense_configs = \App\AdProviderConfig::where('type','=','adsense_ad_code')->where('user_id','=',\Auth::user()->id)->value('config');

    	$adsense_config_array = unserialize($adsense_configs);
    	$adsense_unmodified = \App\AdProviderConfig::where('type','=','adsense_ad_code_unmodified')->where('user_id','=',\Auth::user()->id)->value('config');
    	$contents = \View::make('adjs', ['ad_provider_id' => 1, 'adsense_style'=>$adsense_config_array['style'],'adsense_ad_client'=>$adsense_config_array['adclient'],'adsense_ad_slot'=>$adsense_config_array['adslot'],'lsm_site'=>"",'lsm_ad_key'=>"",'lsm_ad_size'=>"",'lsm_ad_slot'=>""]);

		return \View::make('adsense.adcompare',['page'=>'adsense-ad-compare', 'adsense'=>$contents, 'adsense_unmodified'=>$adsense_unmodified]);
	}
	
}