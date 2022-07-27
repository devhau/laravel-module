<?php

namespace DevHau\Modules\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Filesystem\Filesystem;

class ClearAllCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear-all-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'clear all cache';
    /**
     * The file system instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->files = $filesystem;
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Artisan::command('cache:clear', function () {
        });
        Cache::flush();
        cache()->flush();
        Artisan::command('config:clear', function () {
        });
        Artisan::command('event:clear', function () {
        });
        Artisan::command('route:clear', function () {
        });
        foreach ($this->files->files(storage_path('framework/views')) as $file) {
            $this->files->delete($file);
        }
        Log::info('clear all cache is done');
    }
}
