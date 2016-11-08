<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class JsonModel extends Eloquent
{
    protected $collection;

	public function setTable($collection)
    {
        $this->collection = $collection;

        return $this;
    }

}
