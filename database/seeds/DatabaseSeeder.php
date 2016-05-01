<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(AdProvidersTableSeeder::class);
        $this->call(AdSlotsTableSeeder::class);
        $this->call(AdsTableSeeder::class);
        $this->call(AdSlotConfigsTableSeeder::class);

        Model::reguard();
    }
}
