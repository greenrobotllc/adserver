<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\DailyViews;
use App\IncomeReport;
use App\RpmReport;
use App\AdZoneMapping;
use App\GeographicReport;
use DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $d = Date('Y-m-d');

        $week_x = strtotime('- 7 Days');
        $week_date =(gmdate("Y-m-d",$week_x));

        $last_x = strtotime('- 1 Days');
        $last_date =(gmdate("Y-m-d",$last_x));

                            // TODAY
        $views = DailyViews::where('date',$d)->sum('views');
        $total_adsense_views = DailyViews::where('date',$d)->where('type','adsense')->sum('views');
        $total_lsm_views = DailyViews::where('date',$d)->where('type','lsm')->sum('views');
        $total_other_views = DailyViews::where('date',$d)->where('type','other')->sum('views');

        $lsm_earn_today = IncomeReport::where('date',$d)->where('type','lsm')->sum('income');
        $adsense_earn_today = IncomeReport::where('date',$d)->where('type','adsense')->sum('income');
                                // YESTERDAY
        $views_yesterday = DailyViews::where('date',$last_date)->sum('views');
        $total_adsense_views_yesterday = DailyViews::where('date',$last_date)->where('type','adsense')->sum('views');
        $total_lsm_views_yesterday = DailyViews::where('date',$last_date)->where('type','lsm')->sum('views');
        $total_other_views_yesterday = DailyViews::where('date',$last_date)->where('type','other')->sum('views');
        $lsm_earn_yesterday = IncomeReport::where('date',$last_date)->where('type','lsm')->sum('income');
        $adsense_earn_yesterday = IncomeReport::where('date',$last_date)->where('type','adsense')->sum('income');
                        // WEEK
        $lsm_earn_week = IncomeReport::where('date','>=',$week_date)->where('type','lsm')->get();
        $adsense_earn_week = IncomeReport::where('date','>=',$week_date)->where('type','adsense')->get();
        $total_weekly_income = IncomeReport::where('date','>=',$week_date)->sum('income');

        $lsm_rpm_week = RpmReport::where('date','>=',$week_date)->where('type','lsm')->get();
        $adsense_rpm_week = RpmReport::where('date','>=',$week_date)->where('type','adsense')->get();

        $lsm_view_week = DailyViews::where('date','>=',$week_date)->where('type','lsm')->sum('views');
        $adsense_view_week = DailyViews::where('date','>=',$week_date)->where('type','adsense')->sum('views');
        $other_view_week = DailyViews::where('date','>=',$week_date)->where('type','other')->sum('views');
        
        /*
        * Changes made by Sohail
        * $adzones_view_daily = DailyViews::where('date',$d)->select('adzone','date', DB::raw("sum(views) as totalviews"))->groupBy('adzone')->get();
        */
        
        $adzones_view_daily = DailyViews::where('date',$d)->select('adzone','date', DB::raw("sum(views) as totalviews"))->groupBy('adzone','date')->get();

        $lsm_rpm = DB::table('ads')->where('id', 2)->first();
        $adsense_rpm = DB::table('ads')->where('id',1)->first();

        $adsense_ads = AdZoneMapping::where('type','adsense')->get();
        foreach($adsense_ads as $key=>$ad) {
            $adzone_id=$ad->adzone;
            $zone_report_id = DB::table('adsenses')->where('id', $adzone_id)->value('adsense_zone');
            //print_r($zone_report_id);
            $adsense_id = DB::table('adsense_zones')->where('id', $zone_report_id)->value('adsense_id');
            //print_r($adsense_id);
            $rpm=DB::table('zone_reports')->where('adunit_id', $adsense_id)->value('rpm');
            $adsense_ads[$key]->rpm=$rpm;
            //print_r($rpm);
        }




        $mopub_ads = AdZoneMapping::where('type','mopub')->get();
        //print_r("mopub ads: " . $mopub_ads . "\n");

        foreach($mopub_ads as $key=>$ad) {

            //$adzone_id=$ad->adzone;
            $adzone_id=$ad->add_id;
            //print_r("adzone_id: " . $adzone_id . "\n");
            $zone_report_id = DB::table('mopubs')->where('id', $adzone_id)->value('mopub_zone');
            //print_r("zone report id: " . $zone_report_id);
            $mopub_id = DB::table('mopub_zones')->where('id', $zone_report_id)->value('unit_id');
            //print_r("mopub_id:" . $mopub_id);
            $rpm=DB::table('mopub_zone_reports')->where('adunit_id', $mopub_id)->value('rpm');
            $mopub_ads[$key]->rpm=$rpm;
            //print_r($rpm);
        }



		//print_r($adsense_ads);
        $lsm_ads = AdZoneMapping::where('type','lsm')->get();
        $other_ads = AdZoneMapping::where('type','other')->get();

        $mapDataToday = GeographicReport::where('date',$d)->get();
        $rep = new GeographicReportController;
        $mapJsonToday = $rep->makeOutput($mapDataToday);

        $mapDataYesterday = GeographicReport::where('date',$last_date)->get();
        $mapJsonYesterday = $rep->makeOutput($mapDataYesterday);

        //Adsense calculated benifit of rotation
        $rpm_adsense_last_day = 0;
        foreach ($adsense_rpm_week as $key => $value) {
            if ($value['date'] == $last_date)
            {
                $rpm_adsense_last_day = $value['rpm'];
                break;
            }
        }
        $adsense_income_without_rotation = round((($total_adsense_views_yesterday - $total_adsense_views_yesterday*0.25)/1000) * $rpm_adsense_last_day,2);


        // LSM calculated benifit of rotation
        $rpm_lsm_last_day = 0;
        foreach ($lsm_rpm_week as $key => $value) {
            if ($value['date'] == $last_date)
            {
                $rpm_lsm_last_day = $value['rpm'];
                break;
            }
        }
        $lsm_income_without_rotation = round((($total_lsm_views_yesterday - $total_lsm_views_yesterday*0.25)/1000) * $rpm_lsm_last_day,2);

        $total_without_rotation = $lsm_income_without_rotation + $adsense_income_without_rotation;

        return view('reports.index',
            [
            'page'=>'report',
            'total_views'=>$views,
            'total_adsense_views'=>$total_adsense_views,
            'total_lsm_views'=>$total_lsm_views,
            'total_other_views'=>$total_other_views,
            'lsm_earn_today'=>$lsm_earn_today,
            'adsense_earn_today'=>$adsense_earn_today,

            'total_views_yesterday'=>$views_yesterday,
            'total_adsense_views_yesterday'=>$total_adsense_views_yesterday,
            'total_lsm_views_yesterday'=>$total_lsm_views_yesterday,
            'total_other_views_yesterday'=>$total_other_views_yesterday,
            'lsm_earn_yesterday'=>$lsm_earn_yesterday,
            'adsense_earn_yesterday'=>$adsense_earn_yesterday,


            'lsm_earn_week'=>$lsm_earn_week,
            'adsense_earn_week'=>$adsense_earn_week,
            'lsm_view_week'=>$lsm_view_week,
            'adsense_view_week'=>$adsense_view_week,
            'other_view_week'=>$other_view_week,
            'total_weekly_income'=>$total_weekly_income,
            'adzones_view_daily'=>$adzones_view_daily,
            'lsm_rpm'=>$lsm_rpm,
            'adsense_rpm'=>$adsense_rpm,
            'adsense_ads'=>$adsense_ads,
            'lsm_ads'=>$lsm_ads,
            'mopub_ads'=>$mopub_ads,
            'other_ads'=>$other_ads,
            'lsm_rpm_week'=>$lsm_rpm_week,
            'adsense_rpm_week'=>$adsense_rpm_week,

            'map_data_yesterday'=>$mapDataYesterday,
            'map_data_today'=>$mapDataToday,

            'LSMmapJsonToday'=>$mapJsonToday,
            'LSMmapJsonYesterday'=>$mapJsonYesterday,

            'total_without_rotation'=>$total_without_rotation,
            'adsense_income_without_rotation'=>$adsense_income_without_rotation,
            'lsm_income_without_rotation'=>$lsm_income_without_rotation,
            ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
}
