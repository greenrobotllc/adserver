<?php

use Illuminate\Database\Seeder;

class AdSlotConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('ad_slot_configs')->insert([
        'ad_slot_id' => 1,
        'ad_id' => 1,
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")
      ]);
      DB::table('ad_slot_configs')->insert([
        'ad_slot_id' => 1,
        'ad_id' => 2,
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")
      ]);
      DB::table('ad_slot_configs')->insert([
        'ad_slot_id' => 1,
        'ad_id' => 3,
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")
      ]);
    }
}
