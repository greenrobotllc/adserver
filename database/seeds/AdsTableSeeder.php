<?php

use Illuminate\Database\Seeder;

class AdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('ads')->insert([
        'user_id' => 1,
        'ad_provider_id' => 1,
        'name' => 'adsense 1',
        'active' => 1,
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")
      ]);
      DB::table('ads')->insert([
        'user_id' => 1,
        'ad_provider_id' => 2,
        'name' => 'lsm 1',
        'active' => 1,
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")
      ]);
      DB::table('ads')->insert([
        'user_id' => 1,
        'ad_provider_id' => 3,
        'name' => 'test 1',
        'active' => 1,
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")
      ]);
    }
}
