<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeographicReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geographic_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('country');
            $table->decimal('impressions', 10,3);
            $table->decimal('cost', 10,3);
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('geographic_reports');
    }
}
