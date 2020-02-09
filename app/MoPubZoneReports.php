<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoPubZoneReports extends Model
{
    //
    protected $table = 'mopub_zone_reports';
    protected $fillable = ['adunit_id', 'revenue', 'rpm', 'adunit_name', 'date', 'app', 'platform'];
    
}
