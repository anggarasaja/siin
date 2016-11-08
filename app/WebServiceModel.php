<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebServiceModel extends Model
{
    //
    protected $collection;
    public function __construct($params=array()) {
    
        $this->table = $params['table'];
    
	}
}
