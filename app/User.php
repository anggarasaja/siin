<?php

namespace App;

// use Illuminate\Foundation\Auth\User as Authenticatable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Auth\Authenticatable;
// use Illuminate\Databasse\Eloquent\SoftDeletes;

class User extends Eloquent implements \Illuminate\Contracts\Auth\Authenticatable   
{
    use Authenticatable;
    // use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'nama_lembaga', 'email', 'password', 'jenis', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAuthPassword(){
        return $this->password;
    }
}
