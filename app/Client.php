<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	protected $fillable = ['directory','name'];

    public function assets()
    {
    	return $this->hasMany('App\Asset', 'client_dir', 'directory');
    }
}
