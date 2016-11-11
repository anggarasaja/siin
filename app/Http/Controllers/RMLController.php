<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
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

    public function getAllDt(){
        $records= RMLModel::get();
        return Datatables::of($records)
        ->addColumn('action', function ($row) {
            $button = "<div class='btn-group-vertical'>
                                <button type='button' class='btn btn-primary btn-xs'>Edit</button>
                                <button type='button' class='btn btn-warning btn-xs'>Perbaharui</button>";
            if($row->aktif==null){
                $button = $button."<button type='button' class='btn btn-success btn-xs'>aktifkan</button>";
            } elseif ($row->aktif=='on') {
                 $button = $button."<button type='button' class='btn btn-danger btn-xs'>non-aktifkan</button>";
            }
            return $button;
        })   
        ->editColumn('aktif', function($row){
            if($row->aktif=="on"){
                return '<span class="label label-success">aktif</span>';
            } else if($row->aktif==null){
                return '<span class="label label-danger">non-aktif</span>';
            } else {
                return '<span class="label label-default">unknown</span>';
            }
        })
        ->make(true);
    }
}
