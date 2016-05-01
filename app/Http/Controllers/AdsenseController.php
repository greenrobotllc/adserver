<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//models
use App\AdZone;
use App\Adsense;
use App\AdZoneMapping;

use DB;
use Exception;
use Input;
use View;

use App\Http\Requests\AdsenseRequest;
class AdsenseController extends Controller
{

    private $type = "adsense";


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
        $data  = Adsense::all();
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

        return \View::make('adsense.manage',[
            'data'=>$data,
            'page'=>"adsense",
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
    public function store(AdsenseRequest $request)
    {
        DB::beginTransaction();

        $adsense = new Adsense;
        $AdZoneMapping = new AdZoneMapping;
        try{
            $adsense->name = $request->name;
            $adsense->adcode = $request->adcode;
            $adsense->save();

            $AdZoneMapping->adzone = $request->adzone;
            $AdZoneMapping->add_id = $adsense->id;
            $AdZoneMapping->type = $this->type;
            $AdZoneMapping->weight = 1;
            $AdZoneMapping->save();

        }catch(Exception $e)
        {
            DB::rollBack();
            return \Redirect::to('adsense')->with('error',$e->getMessage());
        }
        


        DB::commit();
        return \Redirect::to('adsense')->with('message', 'Successful Saved');
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
        $data = Adsense::where('id','=',$id)->first();
        $data->zone = AdZone::all();
        $data->adzone = AdZoneMapping::where('add_id',$id)->where('type',$this->type)->first()->adzone;
        return View::make('adsense.showsettings',['data'=>$data]);
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
        $data->adcode = Input::get('adcode');
        $data->name = Input::get('name');
        $data->adzone = Input::get('adzone');

        $db_col = Adsense::whereId($data->id)->first();
        $db_map = AdZoneMapping::where('add_id',$data->id)->where('type',$this->type)->first();
        DB::beginTransaction();
        try{
            $db_col->name = $data->name;
            $db_col->adcode = $data->adcode;
            $db_col->save();

            $db_map->adzone = $data->adzone;
            $db_map->save();
        }catch(Exception $e)
        {
            DB::rollBack();
            error_log($e->getMessage());
            return response("Error Updating Adsense",500);
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
        $affected_rows = Adsense::where('id', $id)->delete();
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

    public function viewadd()
    {
        $id = Input::get('id');
        try{
            echo "<h1>DONT CLICK ON YOUR AD</h1>";
            echo Adsense::whereId($id)->first()->adcode;
        }catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
}
