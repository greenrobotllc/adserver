<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdSlotConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_slot_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ad_slot_id')->nullable();
            $table->integer('ad_id')->nullable();
            $table->float('ad_weight', 10, 4)->nullable();
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
        Schema::drop('ad_slot_configs');
    }
}
