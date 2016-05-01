<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('ads', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->integer('user_id');
          $table->integer('ad_provider_id');
          $table->float('last_rpm', 10, 4)->nullable();
          $table->boolean('active');
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
        Schema::drop('ads');
    }
}
