<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
	protected $fillable = ['client_dir', 'uri'];

    public function client()
    {
    	return $this->belongsTo('App\Client', 'directory', 'client_dir');
    }
}
