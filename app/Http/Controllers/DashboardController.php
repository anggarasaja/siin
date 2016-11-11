<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RMLController;
use App\User;
use App\Http\Requests;

class DashboardController extends Controller
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

    public function frontpage(){
        //rml
        $rml = new RMLController;
        $totalAll = $rml->getAllCount();
        $totalActive = $rml->getActiveCount();
        $totalNotActive = $rml->getNotActiveCount();

        //user
        $totalUser = User::count();

        return view('dashboard.chart',[
            "totalAll"=>$totalAll,
            "totalActive"=>$totalActive,
            "totalNotActive"=>$totalNotActive,
            "totalUser"=>$totalUser
            ]);
    }

    public function rml(){
        return view('dashboard.services');
    }

    

    public function getKategoriLembaga(){
        return $this->barChart("PUI-lembaga-json","kategori_lembaga");
    }
    public function getBentukLembaga(){
        return $this->barChart("PUI-lembaga-json","bentuk_lembaga");
    }
    public function getLembagaInduk(){
        return $this->barChart("PUI-lembaga-json","lembaga_induk");
    } 
    public function getFokusBidang(){
        return $this->barChart("PUI-lembaga-json","fokus_bidang");
    }

    public function getTrl(){
        $name=array();
        $total=array();
        $persentase = array();
        $color = array();
        $records = DB::collection('PUI-produk-json')->raw(function($collection){
            return $collection->aggregate([
                        ['$group' => 
                            [
                                '_id'=>'$trl',
                                'count'=>
                                    [
                                        '$sum'=>1
                                    ]
                            ]
                        ]
                    ]);
        });
        foreach ($records as $record) {
            array_push($name, $record->_id);
            array_push($total, $record->count);
            array_push($color, sprintf('#%06X', mt_rand(0, 0xFFFFFF)));
            // array_push($persentase, round(($record->count/$sum)*100,2));
        }
        $sum= array_sum($total);
        foreach ($total as $value) {
            array_push($persentase, round(($value/$sum)*100,2));
        }
        return json_encode(["name"=>$name,"persentage"=>$persentase,"color"=>$color,"sum"=>array_sum($persentase)]);
    }

    public function barChart($collection, $groupByData){
        $label=array();
        $data=array();
        $records = DB::collection($collection)->raw(function($collection) use ($groupByData){
            return $collection->aggregate([
                        ['$group' => 
                            [
                                '_id'=>'$'.$groupByData,
                                'count'=>
                                    [
                                        '$sum'=>1
                                    ]
                            ]
                        ]
                    ]);
        });
        foreach ($records as $record) {
            array_push($label, $record->_id);
            array_push($data, $record->count);
        }
        return json_encode(["label"=>$label,"data"=>$data]);
    }


}
