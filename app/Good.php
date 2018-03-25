<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    public $timestamps = false;
	protected $hidden = ['pivot'];
	
	public function groups()
    {
	  return $this->belongsToMany('App\GoodGroup', 'listings', 
      'good_id', 'good_group_id');
		//->as('group');
		
        //return $this->belongsToMany('App\GoodGroup')->using('App\Listing');
    }
}
 //return $this->belongsToMany('App\User');