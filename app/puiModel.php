<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
// use Illuminate\Database\Eloquent\Model;

class puiModel extends Eloquent
{
    //
    protected $collection = "pui";

    // public function __construct(){
    // 	Eloquent::unguard();
    // }
}
