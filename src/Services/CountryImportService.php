<?php

namespace Tuna976\csc\Services;

use Illuminate\Support\Facades\File;
use Tuna976\csc\Models\Country;
use Tuna976\csc\Models\State;
use Tuna976\csc\Models\City;

class CountryImportService
{
    public function import()
    {
        $jsonPath = base_path('Tuna976/csc/resources/data/countries_states_cities.json');

        if (!File::exists($jsonPath)) {
            throw new \Exception("JSON file not found at $jsonPath");
        }

        $countries = json_decode(File::get($jsonPath), true);

        foreach ($countries as $countryData) {
            $country = Country::updateOrCreate([
                'iso_code' => $countryData['iso_code'],
            ], [
                'name' => $countryData['name'],
                'phone_code' => $countryData['phone_code'],
            ]);

            foreach ($countryData['states'] as $stateData) {
                // Insert states
                $state = State::updateOrCreate([
                    'name' => $stateData['name'],
                    'country_id' => $country->id,
                ], [
                    'iso_code' => $stateData['iso_code'],
                ]);

                foreach ($stateData['cities'] as $cityData) {
                    // Insert cities
                    City::updateOrCreate([
                        'name' => $cityData['name'],
                        'state_id' => $state->id,
                    ], [
                        'zip_code' => $cityData['zip_code'],
                        'latitude' => $cityData['latitude'],
                        'longitude' => $cityData['longitude'],
                    ]);
                }
            }
        }
    }
}
