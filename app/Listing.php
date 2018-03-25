<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Listing extends Model
{
    public $timestamps = false;
	
   /* public function good() 
	{
		return $this->belongsTo('App\Good');
	}
	
	 public function good_group() 
	{
		return $this->belongsTo('App\GoodGroup');
	}*/
}