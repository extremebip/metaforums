<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repository\Contracts\ITestRepository;

use App\Repository\Repositories\TestRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * List of repositories that needs to be binded
     *
     * @var array
     */
    private $repositories = [
        'TestRepository'
    ];

    /**
     * List of services that needs to be binded
     *
     * @var array
     */
    private $services = [
        'TestService'
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register all repositories
        foreach ($this->repositories as $repository) {
            $this->app->bind("App\Repository\Contracts\I{$repository}",
                             "App\Repository\Repositories\\{$repository}");
        }

        // Register all services
        foreach ($this->services as $service) {
            $this->app->bind("App\Service\Contracts\I{$service}", 
                             "App\Service\Modules\\{$service}");
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
