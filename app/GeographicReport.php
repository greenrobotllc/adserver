<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeographicReport extends Model
{
            protected $fillable = array('country','date','impressions','cost','type');
}
