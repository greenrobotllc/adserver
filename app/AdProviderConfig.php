<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdProviderConfig extends Model
{
	 protected $fillable = array('type', 'config', 'user_id');
	 protected $table = 'adprovider';
}
