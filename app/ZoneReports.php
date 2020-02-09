<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZoneReports extends Model
{
    //
    protected $fillable = ['adunit_id', 'revenue', 'rpm', 'adunit_name', 'date'];
    
}
