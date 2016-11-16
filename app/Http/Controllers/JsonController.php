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
    private $recordsPosition;

    public function __construct($collection,$url,$recordsPosition=0)
    {
        $this->url   = $url;
        $this->collection = $collection;
        if($recordsPosition == null){
            $this->recordsPosition = 0;
        } else {
            $this->recordsPosition = $recordsPosition;
        }
        
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
            echo $this->recordsPosition;
            // exit;
            DB::connection()->disableQueryLog();
            $this->recursiveFunction($obj);
            // foreach ($obj as $document) {
            //     if($recordsPosition == 1){
            //         foreach ($document as $value) {
            //             # code...
            //             print_r($value);
            //             echo "<br><br>";
            //         }
            //     }
            //     // $model = new JsonModel;
            //     // $model->setTable($this->collection);
            //     // $model->data = $document;
            //     // $model->save();
            //     // $i++;
            // }   
                
        });
    }

    public function recursiveFunction($array,$counter=0){
        
        foreach ($array as $document) {
            if($counter != $this->recordsPosition){
                echo $counter;
                $counter++;
                $this->recursiveFunction($document,$counter);
            } else {
                $model = new JsonModel;
                $model->setTable($this->collection);
                $model->data = $document;
                $model->save();
                
                
            }
            
        }


        
         
    }
}
