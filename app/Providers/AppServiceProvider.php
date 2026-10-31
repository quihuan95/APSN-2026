<?php

namespace App\Providers;

use Illuminate\Foundation\Console\ServeCommand;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->keepWindowsUploadTempAvailable();
    }

    /**
     * `php artisan serve` drops TEMP/TMP on Windows, so PHP stores uploads in C:\WINDOWS and they fail.
     */
    private function keepWindowsUploadTempAvailable(): void
    {
        if (PHP_OS_FAMILY !== 'Windows') {
            return;
        }

        $temp = getenv('TEMP') ?: getenv('TMP') ?: storage_path('app/tmp');

        if (! is_dir($temp)) {
            mkdir($temp, 0755, true);
        }

        $_ENV['TEMP'] = $temp;
        $_ENV['TMP'] = $temp;
        $_SERVER['TEMP'] = $temp;
        $_SERVER['TMP'] = $temp;

        ServeCommand::$passthroughVariables = array_values(array_unique([
            ...ServeCommand::$passthroughVariables,
            'TEMP',
            'TMP',
        ]));
    }
}
