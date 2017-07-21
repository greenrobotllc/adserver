<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibertyZoneReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liberty_zone_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('adunit_id');
            $table->string('adunit_name');
            $table->string('app');
            $table->string('platform');
            $table->decimal('revenue', 10,3);
            $table->decimal('rpm', 10,3);
            $table->date('date');
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('liberty_zone_reports');
    }
}
