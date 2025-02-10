<?php

namespace Tuna976\CSC\Providers;

use Illuminate\Support\ServiceProvider;
use Tuna976\CSC\Commands\ImportCountriesCommand;

class CSCServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/country-importer.php', 'country-importer');
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->commands([ImportCountriesCommand::class]);
    }
}
