<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RpmReport extends Model
{
    protected $fillable = array('date','rpm','type','relation');
}
