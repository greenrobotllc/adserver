<?php

use Illuminate\Database\Seeder;

class AdSlotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('ad_slots')->insert([
        'user_id' => 1,
        'location' => 'localhost',
        'ad_id' => 1,
        'last_checked' => date("Y-m-d H:i:s"),
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")
      ]);
    }
}
