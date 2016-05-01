<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Exception;
use DB;
use App\AdZoneMapping;
use App\Http\Controllers\AdzoneController;
use App\AdZone;
use Illuminate\Database\QueryException;

class CustomAddController extends Controller
{

    private $type = "other";
    public function __construct()
    {
        $this->beforeFilter(function(){
           if (!\Auth::check())
        {
           if (\Request::ajax())
            {
                abort(403, 'Unauthorized action.');
            }
            // abort(403, 'Unauthorized action.');
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
        $data = \App\CustomAdd::all();
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
         
        return \View::make('others.manage',['page'=>'othermanage', 'data'=>$data, 'zones'=>$zones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make(
             array('name' => 'Ad Name',
        'adcode' => 'Ad Code',
        'rpm' => 'Ad RPM'),
            array('name' => 'required|min:3',
        'adcode' => 'required|min:5',
        'rpm' => 'required'));
        if ($validator->fails())
        {
                return \Redirect::to('otherads')->withErrors($validator);
        }
        DB::beginTransaction();
        $CustomAdd = new \App\CustomAdd;
        $CustomAdd->name=$request->name;
        $CustomAdd->slug = str_slug($request->name,"-");
        $CustomAdd->rpm = $request->rpm;
        $CustomAdd->adcode=$request->adcode;

        $ZoneMap = new AdZoneMapping;
        $ZoneMap->adzone = $request->adzone;
        $ZoneMap->type=$this->type;


        while (1) {
         try{
        $CustomAdd->save();
        break;
        }catch (QueryException $e)
        {
            DB::rollBack();
            if ( $e->getCode() == 23000){
                $CustomAdd->slug = $CustomAdd->slug."1";
            }else{
                return \Redirect::to('otherads')->with('error','Something Went Wrong! Please Try Later');
            }
        }
        }

        //add the entry in AdZone Mapping
        try{
            $ZoneMap->add_id = $CustomAdd->id;
            $ZoneMap->save();
            //Update values

        }catch(Exception $e)
        {
            DB::rollBack();
             return \Redirect::to('otherads')->with('error',$e->getMessage());
        }
        DB::commit();
        return \Redirect::to('otherads')->with('message', 'Successful Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $id = \Input::get('id');
        echo \App\CustomAdd::where('id','=',$id)->pluck('adcode');
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
    public function update(Request $request)
    {
        $slug = $request->slug;
            DB::beginTransaction();
        try {
            $entry = \App\CustomAdd::where('slug','=',$slug)->first();
            $entry->name = $request->name;
            $entry->rpm = $request->rpm;
            $entry->adcode = $request->adcode;
            $entry->save();
        } catch (\Exception $e) {
            DB::rollBack();
            return response("500", 500);
        }
        DB::commit();
        echo "Custom Ad Updated!";
        return;
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
        $affected_rows = \App\CustomAdd::where('id', $id)->delete();
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

    public function editView()
    {
        $id = \Input::get('id');
        $data = \App\CustomAdd::where('id','=',$id)->first();
        return \View::make('others.showsettings',['data'=>$data]);
    }
    public function updateValues()
    {
        $up = new AdzoneController;
        $up->WeightageCalculator();
    }
}
