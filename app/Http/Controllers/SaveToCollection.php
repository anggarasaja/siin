<?php

namespace App\Http\Controllers;
use App\puiModel;
use App\puiProdukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;

class SaveToCollection extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $json = file_get_contents("http://pui.ristekdikti.go.id/index.php/webservice/getData/getLembaga");
        $obj = json_decode($json,true);
        print_r($obj[0]);
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
        // Model::unguard();

        
            // $puiModel = new puiModel;
            // foreach ($document as $key => $value) {
            //     $puiModel
            
            // }
            
            puiModel::unguarded(function() {
                $json = file_get_contents("http://pui.ristekdikti.go.id/index.php/webservice/getData/getLembaga");
                $obj = json_decode($json, true);
                $i=0;
                foreach ($obj as $document) {
                    puiModel::create($document);
                    // print_r($document);
                    $i++;
                }   
                echo "Berhasil mengambil ".$i." data pada ".date("Y-m-d H:i:s")." dari : \n"."<a href='http://pui.ristekdikti.go.id/index.php/webservice/getData/getLembaga'>http://pui.ristekdikti.go.id/index.php/webservice/getData/getLembaga</a>";
            });
            
        
    }
    public function storeProduk(Request $request)
    {
        //
        // Model::unguard();

        
            // $puiModel = new puiModel;
            // foreach ($document as $key => $value) {
            //     $puiModel
            
            // }
            
            puiModel::unguarded(function() {
                $json = file_get_contents("http://pui.ristekdikti.go.id/index.php/webservice/getData/getProduk");
                $obj = json_decode($json, true);
                $i=0;
                foreach ($obj as $document) {
                    puiProdukModel::create($document);
                    // print_r($document);
                    $i++;
                }   
                 echo "Berhasil mengambil ".$i." data pada ".date("Y-m-d H:i:s")." dari : \n"."<a href='http://pui.ristekdikti.go.id/index.php/webservice/getData/getProduk'>http://pui.ristekdikti.go.id/index.php/webservice/getData/getProduk</a>";

            });
            
        
    }

    public function storetes(){
        // $puiModel = new puiModel;
        // $puiModel->name = 'John';
        // $puiModel->save();
        // DB::unguard();
        puiModel::unguarded(function() {
            return puiModel::create(['name' => 'John', 'telp' =>'098098']);
        });
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $pui = DB::collection('pui')->get();
        $count =  DB::collection('pui')->count();
        echo "terdapat ".$count." data\n\n";
        print("<pre>".print_r($pui,true)."</pre>");
        // return json_encode($pui);
    }

     public function showProduk()
    {
        //
        $puiProduk = DB::collection('pui_produk')->get();
        $count =  DB::collection('pui_produk')->count();
        echo "terdapat ".$count." data\n\n";
        print("<pre>".print_r($puiProduk,true)."</pre>");
        // return json_encode($pui);
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
