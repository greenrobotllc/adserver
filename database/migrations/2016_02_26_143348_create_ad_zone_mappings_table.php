<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdZoneMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_zone_mappings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('adzone');
            $table->integer('add_id');
            $table->decimal('weight', 5,3);
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
        Schema::drop('ad_zone_mappings');
    }
}
