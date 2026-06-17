<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class StoragePrepare extends Command
{
    protected $signature   = 'storage:prepare';
    protected $description = 'Create all required storage subdirectories (safe to run on every deploy)';

    /**
     * Every directory Laravel needs under storage/.
     * These are missing on fresh Amezmo release directories.
     */
    private array $dirs = [
        'storage/app/public',
        'storage/framework/cache/data',
        'storage/framework/sessions',
        'storage/framework/views',
        'storage/logs',
    ];

    public function handle(): int
    {
        $base = base_path();

        foreach ($this->dirs as $dir) {
            $path = $base . DIRECTORY_SEPARATOR . $dir;

            if (! File::isDirectory($path)) {
                File::makeDirectory($path, 0775, recursive: true);
                $this->line("<info>Created</info>  {$dir}");
            } else {
                $this->line("<comment>Exists </comment>  {$dir}");
            }
        }

        // Ensure the log file exists so Laravel can write to it immediately
        $logFile = $base . '/storage/logs/laravel.log';
        if (! File::exists($logFile)) {
            File::put($logFile, '');
            $this->line('<info>Created</info>  storage/logs/laravel.log');
        }

        // Touch a .gitkeep in each dir so empty directories are preserved
        foreach ($this->dirs as $dir) {
            $keep = $base . DIRECTORY_SEPARATOR . $dir . '/.gitkeep';
            if (! File::exists($keep)) {
                File::put($keep, '');
            }
        }

        $this->newLine();
        $this->info('✓ Storage directories ready.');

        return self::SUCCESS;
    }
}
