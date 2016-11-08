<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JsonModel;

use App\Http\Requests;

class JsonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $collection;
    private $url;

    public function __construct($collection,$url)
    {
        $this->url   = $url;
        $this->collection = $collection;
    }

    public function index()
    {
        //
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

    public function getRecords(){
        JsonModel::unguarded(function() {
            $json = file_get_contents($this->url);
            $obj = json_decode($json, true);
            $i=0;
            foreach ($obj as $document) {
                $model = new JsonModel($document);
                $model->setTable($this->collection);
                $model->save();
                $i++;
            }   
                
        });
    }
}
