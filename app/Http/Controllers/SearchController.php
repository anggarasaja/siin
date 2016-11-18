<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\RMLController;

use App\Http\Requests;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data_prefix = "";
        $rml = new RMLController;
        $nama_service = $rml->getServiceName();
        

        $key = Input::get('key',false);
        $id_service = Input::get('id_service',false);

        if($key == false || $id_service == false){
            return view('search',['services'=>$nama_service]);
        }

        $rml = new RMLController;
        $service = $rml->getId($id_service);
        switch($service[0]->jenis){
            case "oai":
                $data_prefix ="metadata";
                break;
            case "json":
                $data_prefix = "data";
                break;
            default :
                break;
        }
        // exit;
        // print_r($key);
        // exit;
        $fields = $service[0]->fields;  
        // print_r($fields);

        $query = DB::collection($service[0]->nama_collection);//->where('data.id','regexp', '/.*kelautan/i');
        foreach ($fields as $value) {
            // echo 'data.'.$value;

            $query = $query->orWhere($data_prefix.'.'.$value,'regexp', '/.*'.$key.'/i');
            // break;
        }

        $result = $query->paginate(5)->appends(['key' => $key,'id_service'=>$id_service]);
        // return $result;
        return view('search',['services'=>$nama_service, 'data'=>$result]);
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
