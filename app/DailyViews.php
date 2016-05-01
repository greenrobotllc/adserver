<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyViews extends Model
{
        protected $fillable = array('ad_id','date','adzone','type');

        public function getadzone()
        {
        	return $this->hasOne('App\AdZone', 'id', 'adzone');
        }

}
