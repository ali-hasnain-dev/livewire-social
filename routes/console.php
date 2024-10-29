<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('clear-livewire-temp', function () {
    (new \App\Console\Commands\ClearLivewireTemp())->handle();
})->purpose('Clear Livewire temp directory')->dailyAt('00:00');
