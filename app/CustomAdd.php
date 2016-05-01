<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomAdd extends Model
{
    protected $fillable = array('name', 'rpm', 'slug', 'adcode', 'updated_at');
    protected $table = 'custom_adds';
}
