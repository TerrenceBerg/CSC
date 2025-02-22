<?php

namespace Tuna976\csc\Commands;

use Illuminate\Console\Command;
use Tuna976\csc\Services\CountryImportService;

class ImportCountriesCommand extends Command
{
    protected $signature = 'country-importer:import';
    protected $description = 'Import countries, states, and cities from a data source';

    public function handle(CountryImportService $importService)
    {
        $importService->import();
        $this->info('Countries, states, and cities imported successfully!');
    }
}
