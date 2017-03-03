<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdsenseZone extends Model
{
    //
    protected $table = 'adsense_zones';
    protected $fillable = ['name', 'adsense_id'];
	
}
