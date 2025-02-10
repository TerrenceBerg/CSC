<?php

namespace Tuna976\CSC\Database\Seeders;

use Illuminate\Database\Seeder;
use Tuna976\CSC\Models\Country;

class CountrySeeder extends Seeder
{
    public function run()
    {
        Country::insert([
            ['name' => 'United States', 'iso_code' => 'US', 'phone_code' => '+1'],
            ['name' => 'Canada', 'iso_code' => 'CA', 'phone_code' => '+1'],
            ['name' => 'United Kingdom', 'iso_code' => 'GB', 'phone_code' => '+44'],
        ]);
    }
}
?>
