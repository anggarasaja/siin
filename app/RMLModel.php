<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class RMLModel extends Eloquent
{
    //
    protected $collection = "rml";
    protected $fillable = array("penyedia","nama_service","deskripsi","jenis","link","aktif","nama_collection");
}
