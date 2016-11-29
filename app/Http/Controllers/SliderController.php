<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use App\SliderModel;
use Datatables;
use App\Http\Requests;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $slider = $this->sliderHTML();
        return view('dashboard.slider',['slider'=>$slider]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($status = null)
    {
        //
        return view('dashboard.input-slider',["status"=>$status,'proses'=>'create']);
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

    public function post_upload(Request $request){
        $this->validate($request, [
            // 'gambar'=> 'mimes:jpg,jpeg,png'
        ]);

        if ($request->hasFile('file')) {
            $gambar = $request->file('file');
            $now = date("YmdHis");

            $tipe = $gambar->getClientOriginalExtension();
            $filenameori = $gambar->getClientOriginalName();
            $fileName = $now.md5($filenameori).'.'.$tipe;
            $gambar->move(
                public_path() . '/uploads/slider/', $fileName
            );
        }

        $slider = new SliderModel;
        if ($request->hasFile('file')) {
            $slider->filename = $fileName;
            $slider->filenameori = $filenameori;
            $slider->tipe = $tipe;
            $slider->aktif = true;
        }
        $slider->save();

        flash('Gambar slider berhasil ditambahkan !','success');
        // return redirect('/slider');
    }

    public function getSliderDt(){
        $records= SliderModel::get();
        return Datatables::of($records)
        ->addColumn('action', function ($row) {
            $button = "
                                <button type='button' class='btn btn-danger btn-xs btn-update btn-hapus' data-filename='".$row->filename."' value='".$row->_id."' id='hapus-".$row->_id."'>Hapus</button>";
            if($row->aktif==null){
                $button = $button."<button type='button' class='btn btn-success btn-xs btn-aktif'  value='".$row->_id."' id='aktif-".$row->_id."'>aktifkan</button>";
            } elseif ($row->aktif=='on') {
                 $button = $button."<button type='button' class='btn btn-warning btn-xs btn-nonaktif' value='".$row->_id."' id='nonaktif-".$row->_id."'>non-aktifkan</button>";
            }
            return $button;
        })->addColumn('gambar', function ($row) {
            $gambar = '<img src="/uploads/slider/'.$row->filename.'" class="img-responsive" alt="'.$row->filenameori.'">';
            return $gambar;
        })->editColumn('aktif', function($row){
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

    public function getSliderActive(){
        return SliderModel::where("aktif","=",true)->get();
    }

    public function sliderHTML(){
        $images = $this->getSliderActive();
        $indicators = '';
        $items = '';
        $active = '';
        $i=0;
        foreach($images as $value){
            if($i==0){
                $indicators = $indicators.'<li data-target="#myCarousel" data-slide-to="'.$i.'" class="active"></li>';
                $active = "active";
   
            } else {
                $indicators = $indicators.'<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>';
                $active = '';

            }

            $items = $items.'<div class="item '.$active.'">
                          <img class="first-slide" src="'.URL::asset('uploads/slider/'.$value['filename']).'" alt="First slide">
                          <div class="container">
                            <div class="carousel-caption">
                                <div class="slider-icon hidden-xs">
                                    <img src="'.URL::asset('img/Logo_SIIN_white.png').'" style="max-width: 150px">
                                </div><!-- /.slider-icon -->
                                <h3 class="carousel-title"> Sistem Informasi IPTEK Nasional</h3>
                            </div><!-- /.carousel-caption -->
                          </div>
                        </div>';

            $i++;
        }


        $html = '<div id="myCarousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">'.$indicators.'</ol>
              <div class="carousel-inner" role="listbox">'.$items.'</div>
              
              <a class="left carousel-control" href="#main-slider" role="button" data-slide="prev">
  <i class="fa fa-angle-left"></i>
</a>
<a class="right carousel-control" href="#main-slider" role="button" data-slide="next">
  <i class="fa fa-angle-right"></i>
</a>';

        return $html;

    }

    public function dropSlider(Request $request){
        $id = $request->input('id');
        $filename = $request->input('filename');
        SliderModel::destroy($id);
        unlink(public_path() . '/uploads/slider/'.$filename);
    }

    public function setActive(Request $request){
        $id = $request->input('id');
        $data = SliderModel::where('_id','=',$id)->first();
        $data->aktif = true;
        $data->save();
    }

    public function setDeactive(Request $request){
        $id = $request->input('id');
        $data = SliderModel::where('_id','=',$id)->first();
        $data->aktif = false;
        $data->save();
    }

    public function downloadTemplate(){
        return response()->download( public_path().'/img/slider/template.jpg');
    }

}
