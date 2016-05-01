<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AdZone;
use App\LSM;
use App\AdZoneMapping;

use DB;
use Exception;
use Input;
use View;

use App\Http\Requests\LSMRequest;
class LSMController extends Controller
{


    private $type = "lsm";


    public function __construct()
    {
        $this->beforeFilter(function(){
           if (!\Auth::check())
        {
           if (\Request::ajax())
            {
                abort(403, 'Unauthorized action.');
            }
            return \Redirect::to('login');
        }
        $this::updateValues();
        });

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data  = LSM::all();
        $zones = AdZone::all();


               //get table name
        $zones_tablename =  with(new AdZone)->getTable();
        $zone_mapping_tablename = with(new AdZoneMapping)->getTable();

        //get the data by joining different tables
        foreach ($data as $key => $value) {
            $temp = AdZoneMapping::where('add_id','=',$value->id)->where('type',$this->type)->join($zones_tablename, $zones_tablename.'.id', '=', $zone_mapping_tablename.'.adzone')->first();
            $data[$key]->zonename = $temp->name;
            $data[$key]->weight = $temp->weight*100 . "%";
        }

        return \View::make('lsm.manage',[
            'data'=>$data,
            'page'=>"LSM",
            'zones'=>$zones
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
    public function store(LSMRequest $request)
    {
        DB::beginTransaction();
        $adsense = new LSM;
        $AdZoneMapping = new AdZoneMapping;
        try{
            $adsense->name = $request->name;
            $adsense->adcode = $request->adcode;
            $adsense->adhead = $request->adhead;
            $adsense->save();

            $AdZoneMapping->adzone = $request->adzone;
            $AdZoneMapping->add_id = $adsense->id;
            $AdZoneMapping->type = $this->type;
            $AdZoneMapping->weight = 1;
            $AdZoneMapping->save();

        }catch(Exception $e)
        {
            DB::rollBack();
            return \Redirect::to('lsm')->with('error',$e->getMessage());
        }

        DB::commit();
        return \Redirect::to('lsm')->with('message', 'Successful Saved');
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
        $data = LSM::where('id','=',$id)->first();
        $data->zone = AdZone::all();
        $data->adzone = AdZoneMapping::where('add_id',$id)->where('type',$this->type)->first()->adzone;
        return View::make('lsm.showsettings',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $data = new \stdclass;
        $data->id = Input::get('id');
        $data->name = Input::get('name');
        $data->adcode = Input::get('adcode');
        $data->adhead = Input::get('adhead');
        $data->adzone = Input::get('adzone');

        $db_col = LSM::whereId($data->id)->first();
        $db_map = AdZoneMapping::where('add_id',$data->id)->where('type',$this->type)->first();
        DB::beginTransaction();
        try{
            $db_col->name = $data->name;
            $db_col->adcode = $data->adcode;
            $db_col->adhead = $data->adhead;
            $db_col->save();

            $db_map->adzone = $data->adzone;
            $db_map->save();
        }catch(Exception $e)
        {
            DB::rollBack();
            error_log($e->getMessage());
            return response("Error Updating LSM",500);
        }
        DB::commit();
        return response("Updated", 200);

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
    public function destroy()
    {
        DB::beginTransaction();
        $id = \Input::get('id');
        $affected_rows = LSM::where('id', $id)->delete();
        if ($affected_rows > 0)
        {
            AdZoneMapping::where('add_id',$id)->where('type',$this->type)->delete();
            echo "Successfully Deleted";
        }else{
            DB::rollBack();
            return response("500", 500);
        }
        DB::commit();
    }
     public function updateValues()
    {
        $up = new AdzoneController;
        $up->WeightageCalculator();
    }


     public function renderadd($id)
    {
        try{
            $ad = LSM::whereId($id)->first();
            return view('lsm.viewadd',['head'=>$ad->adhead,'adcode'=>$ad->adcode]);
        }catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
    public function viewadd()
    {
        $id = Input::get('id');
        $url = url('lsmview')."/".$id;
        echo "<h1>DONT CLICK ON YOUR AD</h1>";
        echo "<iframe src='".$url."' style=\"width:100%;overflow:hidden;padding:0; border:0;\"></iframe>";
        return; 
    }


}
