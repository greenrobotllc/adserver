<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Otherads extends Model
{
    protected $fillable = array('ad_provider','company','slug','rpm','updated_at');
	protected $table = 'other_ads';
}
