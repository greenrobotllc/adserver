<?php

use Illuminate\Database\Seeder;

class AdZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ad_zones')->insert([
        'id' => 1,
        'name' => "Default",
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")
      ]);
    }
}
