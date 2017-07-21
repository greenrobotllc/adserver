<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Liberty;
use App\AdZone;
use App\LibertyZone;
use App\Http\Requests\MoPubRequest;
use DB;
use App\AdZoneMapping;

class LibertyController extends Controller
{
    private $type = "liberty";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data  = Liberty::all();
        $zones = AdZone::all();
        $liberty_zones = LibertyZone::orderBy('name')->get();//AdsenseZone::all();
        //get the data by joining different tables
        $zones_tablename =  with(new AdZone)->getTable();
        $zone_mapping_tablename = with(new AdZoneMapping)->getTable();


        foreach ($data as $key => $value) {
            $temp = AdZoneMapping::where('add_id','=',$value->id)->where('type',$this->type)->join($zones_tablename, $zones_tablename.'.id', '=', $zone_mapping_tablename.'.adzone')->first();
            $data[$key]->zonename = $temp->name;
            $data[$key]->weight = $temp->weight*100 . "%";
        }

        //print_r($data);
               return \View::make('liberty.manage',[
                       'page'=>"Liberty",
                       'zones'=>$zones,
                       'data'=>$data,
                       'liberty_zones'=>$liberty_zones
                           
                       ]);


    }


   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MoPubRequest $request)
    {
        DB::beginTransaction();

        $liberty = new Liberty;
        $AdZoneMapping = new AdZoneMapping;
        try{
            $liberty->name = $request->name;
            $liberty->ad_unit_id = $request->ad_unit_id;
            $liberty->liberty_zone=$request->liberty_zone;
            $liberty->save();

            $AdZoneMapping->adzone = $request->adzone;
            $AdZoneMapping->add_id = $liberty->id;
            $AdZoneMapping->type = $this->type;
            $AdZoneMapping->weight = 1;
            $AdZoneMapping->save();

        }catch(Exception $e)
        {
            DB::rollBack();
            return \Redirect::to('liberty')->with('error',$e->getMessage());
        }
        


        DB::commit();
        return \Redirect::to('liberty')->with('message', 'Successful Saved');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //this is done in manage.blade.php I think
    }



    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
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
