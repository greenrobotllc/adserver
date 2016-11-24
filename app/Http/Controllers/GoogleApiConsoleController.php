<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\GoogleApiConsoleRequest;

use App\Http\Controllers\Controller;
use Exception;

class GoogleApiConsoleController extends Controller
{

    private $filename = '../config/google_client_secrets.json';


    public function __construct()
    {
        //$this->beforeFilter(function(){
        //    if (!\Auth::check())
        // {
        //    if (\Request::ajax())
        //     {
        //         abort(403, 'Unauthorized action.');
        //     }
        //     return \Redirect::to('login');
        // }
        //});

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        try{
            $file = file_get_contents($this->filename);
        }catch(Exception $e)
        {
            $myfile = fopen($this->filename, "w");
            fclose($myfile);
            $file = "";
        }
        // $file = "";
        return view('googleapiconsole.index',['page'=>'googleapiconsole','content'=>$file]);
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
    public function store(GoogleApiConsoleRequest $request)
    {
        try{
        $myfile = fopen($this->filename, "w");
        fwrite($myfile, $request->data);
        fclose($myfile);
        }catch (Exception $e)
        {
            echo $e->getMessage();
        }
        return \Redirect::to('googleapiconsole');
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
