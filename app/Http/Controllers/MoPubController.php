<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MoPub;
use App\AdZone;
use App\AdZoneMapping;
use App\MoPubZone;
use App\Http\Requests\MoPubRequest;
use Illuminate\Support\Facades\Log;

use DB;
use Exception;
use Input;
use View;

class MoPubController extends Controller
{
    //
    

    private $type = "mopub";


    public function __construct()
    {

        $this->middleware('auth');
        // $this::updateValues();

    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data  = MoPub::all();
        $zones = AdZone::all();
        $mopub_zones = MoPubZone::orderBy('name')->get();//AdsenseZone::all();


        //get table name
        $zones_tablename =  with(new AdZone)->getTable();
        $zone_mapping_tablename = with(new AdZoneMapping)->getTable();


            
        //get the data by joining different tables
        foreach ($data as $key => $value) {
            $temp = AdZoneMapping::where('add_id', '=', $value->id)->where('type', $this->type)->join($zones_tablename, $zones_tablename.'.id', '=', $zone_mapping_tablename.'.adzone')->first();
            $data[$key]->zonename = $temp->name;
            $data[$key]->weight = $temp->weight*100 . "%";
        }

                return \View::make(
                    'mopub.manage', [
                       'page'=>"MoPub",
                       'zones'=>$zones,
                       'data'=>$data,
                          'mopub_zones'=>$mopub_zones
                           
                       ]
                );

    }
    
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        DB::beginTransaction();
        $id = \Input::get('id');
        $affected_rows = MoPub::where('id', $id)->delete();
        print_r($affected_rows);
        if ($affected_rows > 0) {
            AdZoneMapping::where('add_id', $id)->where('type', $this->type)->delete();
            echo "Successfully Deleted";
        }else{
            DB::rollBack();
            return response("500", 500);
        }
        DB::commit();
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $id = Input::get('id');
        $data = MoPub::where('id', '=', $id)->first();
        $data->zone = AdZone::all();
        $data->adzone = AdZoneMapping::where('add_id', $id)->where('type', $this->type)->first()->adzone;
        $data->my_ad=MoPub::whereId($id)->first()->mopub_zone;
        
        $data->mopub_zone = MoPubZone::orderBy('name')->get();
        
        return View::make('mopub.showsettings', ['data'=>$data]);
    }
    
    
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $data = new \stdclass;
        $data->id = Input::get('id');
        $data->name = Input::get('name');
        $data->ad_unit_id = Input::get('ad_unit_id');
        
        $data->adzone = Input::get('adzone');
        
        $data->mopub_zone = Input::get('mopub_zone');
        Log::debug($data->mopub_zone);
        //$data->adsense_zone=2;
        $db_col = MoPub::whereId($data->id)->first();
        $db_map = AdZoneMapping::where('add_id', $data->id)->where('type', $this->type)->first();
        DB::beginTransaction();
        try{
            $db_col->name = $data->name;
            $db_col->ad_unit_id = $data->ad_unit_id;
            $db_col->mopub_zone = $data->mopub_zone;
            $db_col->save();

            $db_map->adzone = $data->adzone;
            $db_map->save();
        }catch(Exception $e)
        {
            DB::rollBack();
            error_log($e->getMessage());
            return response("Error Updating MoPub", 500);
        }
        DB::commit();
        return response("Updated", 200);

    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MoPubRequest $request)
    {
        DB::beginTransaction();

        $mopub = new MoPub;
        $AdZoneMapping = new AdZoneMapping;
        try{
            $mopub->name = $request->name;
            $mopub->ad_unit_id = $request->ad_unit_id;
            $mopub->mopub_zone=$request->mopub_zone;
            $mopub->save();

            $AdZoneMapping->adzone = $request->adzone;
            $AdZoneMapping->add_id = $mopub->id;
            $AdZoneMapping->type = $this->type;
            $AdZoneMapping->weight = 1;
            $AdZoneMapping->save();

        }catch(Exception $e)
        {
            DB::rollBack();
            return \Redirect::to('mopub')->with('error', $e->getMessage());
        }
        


        DB::commit();
        return \Redirect::to('mopub')->with('message', 'Successful Saved');
    }
    
}
