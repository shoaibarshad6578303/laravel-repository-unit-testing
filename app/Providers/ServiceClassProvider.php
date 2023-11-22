<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\services\StudentService;
use App\Interfaces\Services\StudentServiceInterface;

class ServiceClassProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StudentServiceInterface::class, StudentService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
