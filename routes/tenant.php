<?php

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider
| with the tenancy and web middleware groups. Good luck!
|
*/

// Route::get('/app', function () {
//     return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
// });


Route::get('/', function () {
    return view('welcome');
  });
  
  
//   Route::group(['middleware' => 'timezone_check'], function () {
//       // AUTHENTICATION ONLY
      Route::get('login', 'AdminController@showlogin');
      Route::post('admin', 'AdminController@dologin');
      Route::get('logout', 'AdminController@dologout');
      Route::get('admin', 'AdminController@showhome');
      Route::get('lsm-ad-config','AdminController@lsmAdConfig');
      Route::get('adsense-ad-config','AdminController@adsenseAdConfig');
      Route::get('lsm-ad-compare','AdminController@lsmAdCompare');
      Route::get('adsense-ad-compare','AdminController@adsenseAdCompare');
  
       // Ad Zones
      Route::get('adzone','AdzoneController@index');
      Route::post('viewadzone','AdzoneController@showopt');
      Route::put('adzone','AdzoneController@update');
      Route::post('adzone','AdzoneController@store');
      Route::post('showcode','AdzoneController@show');
  
      // Other Ads
      Route::get('otherads','CustomAddController@index');
      Route::post('otherads','CustomAddController@store');
      Route::post('viewadd','CustomAddController@show');
      Route::post('editcustomadd','CustomAddController@editview');
      Route::put('editcustomadd','CustomAddController@update');
      Route::delete('deletecustomadd','CustomAddController@destroy');
  
       // Ad Settings
      Route::get('api','ApiController@clientview');
      Route::post('api','ApiController@verifyH');
  
       // Admin Controller
      Route::get('refresh','AdminController@refresh');
      Route::post('saveadsense','AdminController@saveAdsense');
      Route::post('savelsm','AdminController@saveLSM');
      Route::post('savemopub','AdminController@saveMopub');
      Route::post('saveliberty','AdminController@saveLiberty');
      Route::post('saveadsensecode','AdminController@updateAdsenseAdCode');
      Route::post('savelsmcode','AdminController@updateLsmAdCode');
  
      //Adsense
      Route::get('adsense','AdsenseController@index');
      Route::post('adsense','AdsenseController@store');
      Route::delete('adsense',"AdsenseController@destroy");
      Route::post('adsenseview',"AdsenseController@viewadd");
      Route::post('adsenseeditview','AdsenseController@show');
      Route::put('adsense','AdsenseController@edit');
  
  
      //MoPub
      Route::get('mopub','MoPubController@index');
      Route::post('mopub','MoPubController@store');
      Route::delete('mopub',"MoPubController@destroy");
      Route::put('mopub','MoPubController@edit');
      Route::post('mopubeditview','MoPubController@show');
  
  
      //LSM
      Route::get('lsm','LSMController@index');
      Route::post('lsm','LSMController@store');
      Route::delete('lsm',"LSMController@destroy");
      Route::post('lsmview',"LSMController@viewadd");
      Route::post('lsmeditview','LSMController@show');
      Route::put('lsm','LSMController@edit');
      Route::get('lsmview/{id}','LSMController@renderadd');
  
      //liberty
      Route::resource('liberty','LibertyController');
      Route::post('libertyeditview','LibertyController@show');
  
  
      //Display Add
      Route::get('getad/{id}',"DisplayAddController@index")->where('id', '[0-9]+');
  
      //Display native mobile ad
      Route::get('getadmobile/{id}',"DisplayAddController@indexmobile")->where('id', '[0-9]+');
  
      //GoogleApiJSONEditor
      Route::get('googleapiconsole','GoogleApiConsoleController@index');
      Route::post('googleapiconsole','GoogleApiConsoleController@store');
  
      //Report
      Route::resource('report','ReportController');
  
  
      //Help
      Route::get('help','HelpController@index');
  
      //Reset Login
      Route::get('resetlogin','AdInfoController@deleteAccessToken');
  
      //TimeZone
      Route::resource('timezone','TimeZoneController');
  
      // Weightage Calculator
      Route::get('wrefresh','AdzoneController@WeightageCalculator');
  
  //});
  