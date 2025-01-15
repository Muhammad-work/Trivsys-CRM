<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\UpdateCustomerDuration;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


        // Determine the month and year to query based on the provided date or current date
// Schedule::command(UpdateCustomerDuration::class)->everySecond()->runInBackground();
