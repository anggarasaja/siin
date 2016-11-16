<?php

namespace App\Http\Controllers;

use App\Http\Controllers\RMLController;
use App\Http\Controllers\OaiController;
use App\Http\Controllers\JsonController;
use App\WebServiceModel;
use App\Jobs\UpdateData;
use Illuminate\Http\Request;

use App\Http\Requests;

class WebServiceUpdater extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    public function UpdateByIdAsync($id){
        $this->dispatch(new UpdateData($id));
    }

    public function updateLocal(){
        $RML = new RMLController;
        $activeServices = $RML->getActive();
        $this->execUpdate($documents);
    }

    public function updateByType($type){
        // echo $type;
        $RML = new RMLController;
        $documents = $RML->getActiveByType($type);
        // print_r($documents);
        $this->execUpdate($documents);

    }

    public function updateByProvider($provider){
        $RML = new RMLController;
        $documents = $RML->getActiveByProvider($provider);
        // print_r($documents);
        $this->execUpdate($documents);
    }

    public function updateByServiceName($serviceName){
        $RML = new RMLController;
        $documents = $RML->getActiveByServiceName($serviceName);
        // print_r($documents);
        $this->execUpdate($documents);
    }

    public function execUpdate($documents){
        if($documents->count()==0){
            echo "Web Service tidak ditemukan";
            exit;
        }
        foreach ($documents as $document) {
            switch ($document->jenis) {
                case 'oai':
                    $this->getOai($document);
                    echo "oai";
                    break;
                case "json":
                   $this->getJson($document);
                    echo "json";
                    break;
                case "xml":
                    echo "xml";
                    break;
                default:
                    echo "kosong";
                    break;
            }
        
        }
    }

    public function getOai($document){
        $oaiController = new OaiController($document->nama_collection,$document->link);
        $oaiController->getRecords();
    }
    public function getJson($document){
        echo $document->link;
        $jsonController = new JsonController($document->nama_collection,$document->link,$document->posisi_record);
        $jsonController->getRecords();
    }
}
