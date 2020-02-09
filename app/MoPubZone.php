<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoPubZone extends Model
{
    //
    protected $table = 'mopub_zones';
    protected $fillable = ['name', 'unit_id', 'app', 'platform'];
    
}
