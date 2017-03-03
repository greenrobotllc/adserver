<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AdZone;
use App\AdZoneMapping;
use App\CustomAdd;
use App\Http\Requests\AdZoneRequest;
use App\Adsense;
use App\Ad;
use App\LSM;
use Exception;
use Response;
use Input;
use DB;
use View;

class AdzoneController extends Controller
{

    public function __construct($check = true)
    {
        //if ($check):
		$this->middleware('auth');
	
			 
       // $this->middleware(function(){
           // if (!\Auth::check())
       //  {
       //     if (\Request::ajax())
       //      {
       //          abort(403, 'Unauthorized action.');
       //      }
       //      // abort(403, 'Unauthorized action.');
       //      return \Redirect::to('login');
       //  }
        //});
        //endif;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AdZone::all();
        foreach ($data as $key => $value) {
            $value->ad_count = 0;
            $value->ad_count = AdZoneMapping::where('adzone','=',$value->id)->count();
        }
        return \View::make('adzone.main',['page'=>'adzone','zones'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdZoneRequest $request)
    {
        try{
            $data = new AdZone;
            $data->name = $request->name;
            $data->platform = $request->platform;
            $data->save();
        }catch(Exception $e)
        {
            return \Redirect::to('adzone')->with('error',$e->getMessage());
        }
        return \Redirect::to('adzone')->with('message','Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $id = Input::get('id');
        return View::make('adzone.showcode',['id'=>$id]);
    }


    public function showopt()
    {
        $id = Input::get('id');
        $data = AdZone::where('id','=',$id)->first();
        return View::make('adzone.showsettings',['data'=>$data]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdZoneRequest $request)
    {
        try{
            $id = $request->id;
            $name = $request->name;
            $platform = $request->platform;
            $zone = AdZone::where('id',$id)->first();
            $zone->name=$name;
            $zone->platform=$platform;
            $zone->save();
            return response("Adzone Updated", 200);
        }catch(Exception $e)
        {
           return response("Unable to update Adzone <br>".$e->getMessage(), 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
   

    public function WeightageCalculator()
    {
        $logging = ".:: Processing Weightage Calculator::.<br />";
        $logging .= "Starting Updating AdZones";
        try{
            //get all zones in the database
            $data = AdZone::all();
            //initialize required variables usuallay counter variables
            $rpm_index = $total = $ipx = $total_cms = 0;
            $rpm_c = array();
            foreach ($data as $key => $value) {
                //get all adds in each zone
                $ad_id[$key] = AdZoneMapping::where('adzone','=',$value->id)->get();
                
                foreach ($ad_id[$key] as $key1 => $value1) {
                    switch ($value1->type) {
                        case 'adsense':
                            $rpm[$key][$rpm_index] = Adsense::where('id','=',$value1->add_id)->first();
                            //$rpm[$key][$rpm_index]->rpm = Ad::where('name','adsense 1')->first()->last_rpm;
							$adzone_id=$rpm[$key][$rpm_index]->adsense_zone;
							print_r("adzone_id = $adzone_id");
							//$zone_report_id = DB::table('adsenses')->where('id', $adzone_id)->value('adsense_zone');
							//print_r($zone_report_id);
							//print_r("zone_report_id = $zone_report_id");
							
							$adsense_id = DB::table('adsense_zones')->where('id', $adzone_id)->value('adsense_id');
							print_r("adsense_id = $adsense_id");
							
							//print_r($adsense_id);
							$myRpm=DB::table('zone_reports')->where('adunit_id', $adsense_id)->value('rpm');
							//print_r("rpm is $rpm");
							$rpm[$key][$rpm_index]->rpm=$myRpm;
							
							//$zone_report_id = DB::table('adsenses')->where('id', $adzone_id)->value('adsense_zone');
							//print_r($zone_report_id);
							//$adsense_id = DB::table('adsense_zones')->where('id', $zone_report_id)->value('adsense_id');
							//print_r($adsense_id);
							//$rpm=DB::table('zone_reports')->where('adunit_id', $adsense_id)->value('rpm');
                            
							
							$total += $rpm[$key][$rpm_index]->rpm;
                            break;
                        case 'lsm':
                            $rpm[$key][$rpm_index] = LSM::where('id','=',$value1->add_id)->first();
                            $rpm[$key][$rpm_index]->rpm = Ad::where('name','lsm 1')->first()->last_rpm;
                            $total += $rpm[$key][$rpm_index]->rpm;
                            break;
                        
                        default:
                            //get the custom add details
                            $rpm[$key][$rpm_index] = CustomAdd::where('id','=',$value1->add_id)->first();
                            $total += $rpm[$key][$rpm_index]->rpm;
                            break;
                    }
                    $rpm_index++;
                }
                //Total Original RPM per zone is in $total
                if ($total == 0)
                {
                    $total = 0.1;
                }
                // Total RPM Average per zone is in $average
                // if (count($ad_id[$key]) != 0)
                // {
                //    $average = $total/count($ad_id[$key]);
                // }
                // $average = $total;
                // error_log("Average: ".count($ad_id[$key]));
                // if (!$ad_id[$key]):
                 // $logging .= "<br />Key: ".$key;
                foreach ($rpm[$key] as $value2) {
                    $total_cms += $value2->rpm + 0.001;// + $average;
                    $rpm_c[$ipx++] = $value2->rpm + 0.001;// + $average;
                }
                 // $logging .= "<br />Key done";
                // endif;
                // Added Average RPM per ad is in $rpm_c
                // Total Added Average RPM Per Zone is in $total_cms
                foreach ($rpm_c as $key3 => $value3) {
                    //Percentage is calculated and stored against each AdZone Mapping Ad
                    $ad_id[$key][$key3]->weight = $value3/$total_cms;
                    // error_log("Total: ".$total_cms." key:".$key3);
                    $ad_id[$key][$key3]->save();
                }

                //Reset all the variables
                $rpm_index = $total = $ipx = $total_cms = 0;
                $rpm_c = array();
                // $logging .= "<br />new done ".$value1->type;
            }
        }catch(Exception $e)
        {
            $logging .= "<br />!!! Error updating AdZones - ".$e->getMessage()." !!!";

            error_log("Error updating AdZones - ".$e->getMessage());
            return $logging;
        }
        $logging .= "<br />AdZone Updated";
        return $logging;
    }


}
