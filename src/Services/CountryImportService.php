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
        $countriesPath = __DIR__ . '/../resources/data/countries.json';
        $statesPath = __DIR__ . '/../resources/data/states.json';
        $citiesPath = __DIR__ . '/../resources/data/cities.json';

        if (!File::exists($countriesPath) || !File::exists($statesPath) || !File::exists($citiesPath)) {
            throw new \Exception("One or more JSON files are missing.");
        }

        $countries = json_decode(File::get($countriesPath), true);
        $states = json_decode(File::get($statesPath), true);
        $cities = json_decode(File::get($citiesPath), true);

        // Insert countries
        $countryMap = []; // To store country IDs for reference
        foreach ($countries as $countryData) {
            $country = Country::updateOrCreate(
                ['iso_code' => $countryData['iso_code']],
                ['name' => $countryData['country'], 'phone_code' => $countryData['phone_code']]
            );

            $countryMap[$countryData['id']] = $country->id; // Store mapped ID
        }

        // Insert states
        $stateMap = []; // To store state IDs for reference
        foreach ($states as $stateData) {
            $state = State::updateOrCreate(
                ['id' => $stateData['id']],
                [
                    'name' => $stateData['state_name'],
                    'country_id' => $countryMap[$stateData['county_id']] ?? null,
                ]
            );

            $stateMap[$stateData['id']] = $state->id; // Store mapped ID
        }

        // Insert cities
        foreach ($cities as $cityData) {
            City::updateOrCreate(
                ['name' => $cityData['city_name'], 'state_id' => $stateMap[$cityData['state_id']] ?? null],
                [
                    'zip_code' => $cityData['zip_code'],
                    'latitude' => $cityData['latitude'],
                    'longitude' => $cityData['longitude'],
                ]
            );
        }
    }
}
