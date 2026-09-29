<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\JadwalChecker;
use App\Services\RekamMedisJadwalChecker;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(JadwalChecker::class, RekamMedisJadwalChecker::class);
    }

    public function boot()
    {
        //
    }
}