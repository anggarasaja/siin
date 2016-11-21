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

    
    //PUI
    public function getKategoriLembaga(){
        return $this->barChart(env('PUI_LEMBAGA', 'PUI-produk-json'),"kategori_lembaga",'data');
    }
    public function getBentukLembaga(){
        return $this->barChart(env('PUI_LEMBAGA',"PUI-lembaga-json"),"bentuk_lembaga",'data');
    }
    public function getLembagaInduk(){
        return $this->barChart(env('PUI_LEMBAGA',"PUI-lembaga-json"),"lembaga_induk",'data');
    } 
    public function getFokusBidang(){
        return $this->barChart(env('PUI_LEMBAGA',"PUI-lembaga-json"),"fokus_bidang",'data');
    }
    public function getLibtangPUI(){

    }
    public function getTrl(){
        return json_encode($this->pieChart(env('PUI_PRODUK','PUI-produk-json'),"trl",'data'));
    }
    public function getPUI(){
        $ar = $this->pieChart(env('PUI_LEMBAGA','PUI-produk-json'),"tahun_penetapan",'data');
        // print_r($ar);echo "<br><br>";
        $ar['name'] = array_replace($ar['name'],array_fill_keys(array_keys($ar['name'], '0000'),'Belum ditetapkan'));
        return json_encode($ar);
    }
    //PDII-LIPI
    public function getBidangPenelitian(){
        return json_encode($this->pieChart(env('PDII_ISJD','PDII-LIPI-ISJD_oai-oai'),"subject",'metadata'));
    }
    public function getLitbang(){
        return json_encode($this->barChart(env('PDII_ELIB','PDII-LIPI-elib-oai'),"publisher",'metadata'));
    }
    public function pieChart($collection,$groupByData,$prefix){
        $name=array();
        $total=array();
        $persentase = array();
        $color = array();
        $rml = DB::collection('rml')->where('nama_collection','=',$collection)->get();
        $update_version = $rml[0]['update_version'];
        $records = DB::collection($collection)->raw(function($collection) use ($groupByData,$prefix,$update_version){
            return $collection->aggregate([
                        [
                        '$match' => [ 'update_version' => $update_version ]
                        ],
                        [
                        '$group' => 
                            [
                                '_id'=>'$'.$prefix.'.'.$groupByData,
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
        return ["name"=>$name,"persentage"=>$persentase,"color"=>$color,"sum"=>$sum];
    }

    public function barChart($collection, $groupByData, $prefix){
        $label=array();
        $data=array();
        $rml = DB::collection('rml')->where('nama_collection','=',$collection)->get();
        $update_version = $rml[0]['update_version'];
        $records = DB::collection($collection)->raw(function($collection) use ($groupByData,$prefix,$update_version){
            return $collection->aggregate([
                        [
                        '$match' => [ 'update_version' => $update_version ]
                        ],
                        ['$group' => 
                            [
                                '_id'=>'$'.$prefix.'.'.$groupByData,
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
