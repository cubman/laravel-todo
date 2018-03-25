<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodGroup extends Model
{
    public $timestamps = false;
	protected $hidden = ['pivot'];
	
	public function goods()
    {
	  return $this->belongsToMany('App\Good', 'listings', 
      'good_group_id', 'good_id');
		//->as('group');
		
        //return $this->belongsToMany('App\GoodGroup')->using('App\Listing');
    }
    
}
