<?php

namespace App\Providers;
use App\Repository\DepartmentRepository;
use App\Repository\DepartmentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


        $this->app->bind( DepartmentRepositoryInterface::class,  DepartmentRepository::class);
    }
}
