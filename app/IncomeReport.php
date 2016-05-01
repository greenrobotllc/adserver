<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomeReport extends Model
{
        protected $fillable = array('date','income','type');
}
