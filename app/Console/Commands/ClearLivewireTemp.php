<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearLivewireTemp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-livewire-temp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear the livewire-temp directory';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = storage_path('app\livewire-tmp');

        if (is_dir($path)) {
            File::cleanDirectory($path);
            $this->info('Livewire-temp directory cleared.');
        } else {
            $this->error("The specified path does not exist or is not a directory: $path");
        }

        return 0;
    }
}
