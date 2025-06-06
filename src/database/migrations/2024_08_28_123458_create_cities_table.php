<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration {
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('city_name');
            $table->string('zip_code');            
            $table->foreignId('state_id')->constrained('states')->onDelete('cascade');
            $table->string('state_name');
            $table->string('state_postal_abbreviation');
            $table->string('county_name');
            $table->string('county_fips');
            $table->string('timezone');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
?>
