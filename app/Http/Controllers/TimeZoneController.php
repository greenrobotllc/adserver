<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TimeZoneRequest;
use App\Http\Controllers\Controller;

use View;
use App\AdProviderConfig;
use Redirect;

class TimeZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('timezone.modal');
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
    public function store(TimeZoneRequest $request)
    {
        // $file = '../.env';
        // // Open the file to get existing content
        // $current = file_get_contents($file);
        // // Append a new person to the file
        // $current .= "\n TIMEZONE = ".$request->timezone." \n";
        // // Write the contents back to the file
        // file_put_contents($file, $current);
        $data = AdProviderConfig::firstOrNew(array('type' => 'timezone','user_id'=>\Auth::id()));
        $data->config = $request->timezone;
        $data->save();
        return Redirect::to('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id=0)
    {
        $d = AdProviderConfig::where('type','timezone')->first();
        if (!$d)
        {
            return \Config::get('app.timezone');
        }
        return $d->config;
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

    public static function isTimeZoneSet()
    {
        $person = AdProviderConfig::where('type','timezone')->first();
        if ($person)
        {
            return true;
        }
        return false;
    }
}
