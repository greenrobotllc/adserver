<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibertyZoneReports extends Model
{
    //
    protected $fillable = ['adunit_id', 'revenue', 'rpm', 'adunit_name', 'date', 'app', 'platform'];
}
