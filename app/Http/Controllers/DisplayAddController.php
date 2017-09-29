<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Response;
use View;
use App\Adsense;
use App\CustomAdd;
use App\LSM;
use App\MoPub;
use App\Liberty;
use App\DailyViews;
use Exception;

class DisplayAddController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ad_slot_id)
    {
        try{
            $data = DB::table('ad_zone_mappings')->select('add_id', 'weight', 'type')->where('adzone', $ad_slot_id)->orderBy(DB::raw('-LOG(RAND())/weight'), 'asc')->take(1)->first();
            switch ($data->type) {
                case 'adsense':
                    $code= Adsense::where('id',$data->add_id)->first()->adcode;
                    break;
                case 'mopub':
                    $code= MoPub::where('id',$data->add_id)->first()->adcode;
                case 'liberty':
                    //$code= Liberty::where('id',$data->add_id)->first()->adcode;
                    $ad_unit_id=Liberty::where('id', $data->add_id)->first()->ad_unit_id;
                    $code="<iframe width=\"728px\" scrolling=\"no\" height=\"90px\"  frameBorder=\"0\" src=\"https://dev.adnetwork.greenrobot.com/ads/randomad?wid=$ad_unit_id\"></iframe>";
                    //dd($ad_unit_id);
                    break;
                case 'lsm':
                    $query = LSM::where('id',$data->add_id)->first();
                    $code = $query->adhead . $query->adcode;
                    break;
                default:
                    $code = CustomAdd::where('id',$data->add_id)->first()->adcode;
                    break;
            }
            //update views
            $this::views($data->add_id,$data->type);

            //reporting
            $this::incrementDaily($data->add_id, $data->type, $ad_slot_id);

            $codearray = explode("\n", addslashes($code));
            $contents = View::make('uads',['add_code'=>$codearray]);
        }catch(Exception $e)
        {
            $contents = "";
            echo $e->getMessage();
        }

        $response = Response::make($contents, 200);
        $response->header('Content-Type', 'application/javascript');
        return $response;
    }




/**
     * Display a listing of the resource for native mobile ads
     *
     * @return \Illuminate\Http\Response
     */
    public function indexmobile($ad_slot_id)
    {
        try{
            //$data = DB::table('ad_zone_mappings')->select('add_id', 'weight', 'type')->where('adzone', $ad_slot_id)->orderBy(DB::raw('-LOG(RAND())/weight'), 'asc')->take(1)->first();
            $myData = DB::table('ad_zone_mappings')->select('weight', 'type')->where('adzone', $ad_slot_id)->get();
            //print_r($myData);
            return response()->json(
                $myData
            );

            // //return;
            // switch ($data->type) {
            //     case 'adsense':
            //         $code= Adsense::where('id',$data->add_id)->first()->adcode;
            //         break;
            //     case 'mopub':
            //         $code= MoPub::where('id',$data->add_id)->first()->adcode;
            //         break;
            //     case 'lsm':
            //         $query = LSM::where('id',$data->add_id)->first();
            //         $code = $query->adhead . $query->adcode;
            //         break;
            //     default:
            //         $code = CustomAdd::where('id',$data->add_id)->first()->adcode;
            //         break;
            // }
            // //update views
            // $this::views($data->add_id,$data->type);

            // //reporting
            // $this::incrementDaily($data->add_id, $data->type, $ad_slot_id);

            // $codearray = explode("\n", addslashes($code));
            // $contents = View::make('uads',['add_code'=>$codearray]);
        }catch(Exception $e)
        {
            $contents = "";
            echo $e->getMessage();
        }

        $response = Response::make($contents, 200);
        $response->header('Content-Type', 'application/javascript');
        return $response;
    }





    private function views($id, $type)
    {
        switch ($type) {
            case 'adsense':
                $code= Adsense::where('id',$id)->first();
                break;
            case 'lsm':
                $code = LSM::where('id',$id)->first();
                break;
            case 'mopub':
                $code = MoPub::where('id',$id)->first();
                break;
            case 'liberty':
                $code = Liberty::where('id',$id)->first();
                break;
            default:
                $code = CustomAdd::where('id',$id)->first();
                break;
        }
        try{
            $code->increment('views');
            $code->save();
        }catch(Exception $e)
        {
            error_log("Unable to Update Views of ad in DisplayAddController");
            error_log($e->getMessage());
        }
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

    private function incrementDaily($ad_id, $type, $adzone)
    {
        // try{
            $date = Date('Y-m-d');
            $db = DailyViews::firstOrNew(['ad_id'=>$ad_id,'type'=>$type,'adzone'=>$adzone,'date'=>$date]);
            $db->save();
            $db->increment('views');
            $db->save();
        // }catch(Exception $e)
        // {
        //     echo $e->getMessage();
        // }
    }
}
