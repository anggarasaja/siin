<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class OaiModel extends Eloquent
{
    //
    protected $collection ;
    // protected $fillable = ["header","metadata"];

	// public function __construct($params=array()) {
	// 	// parent::__construct();
	// 	if (isset($params['collection'])) {
	// 		$this->collection = $params['collection'];
	// 	}
	// }

	public function setTable($collection)
    {
        $this->collection = $collection;

        return $this;
    }
}
