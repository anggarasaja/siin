<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\RMLModel;

class RMLController extends Controller
{
    const SUCCESS = "success";
    const FAIL = "fail";
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
    public function create($status = null)
    {
        //
        // $rml = new RMLModel;
        return view('rml.create',["status"=>$status]);
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
        $penyedia = $request->penyedia;
        $namaservice = $request->namaservice;
        $deskripsi = $request->deskripsi;
        $jenis = $request->jenis;
        $link = $request->link;
        $aktif = $request->aktif;
        $nama_collection = str_replace(' ', '_', $penyedia."-".$namaservice."-".$jenis);

        $save = RMLModel::create(["penyedia"=>$penyedia,"nama_service"=>$namaservice,"jenis"=>$jenis,"deskripsi"=>$deskripsi,"link"=>$link,"aktif"=>$aktif, "nama_collection"=>$nama_collection]);
        // print_r($save);
        // echo "sukses";
        return redirect()->route('inputRML', ["success"]);

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

    public function getActive(){
        $result = RMLModel::where('aktif', '=', 'on')->get();

        return $result;
    }

    public function getActiveByType($type){
        $result = RMLModel::where('aktif', '=', 'on')->where('jenis','=',$type)->get();
        return $result;
    }
    public function getActiveByProvider($provider){
        $result = RMLModel::where('aktif', '=', 'on')->where('penyedia','=',$provider)->get();
        return $result;
    }
    public function getActiveByServiceName($serviceName){
        $result = RMLModel::where('aktif', '=', 'on')->where('nama_service','=',$serviceName)->get();
        return $result;
    }
}
