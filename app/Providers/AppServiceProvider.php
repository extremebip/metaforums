<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * List of repositories that needs to be binded
     *
     * @var array
     */
    private $repositories = [
        'TestRepository',
        'CategoryRepository',
        'SubCategoryRepository',
        'RoleRepository',
        'ModeratingTypeRepository',
        'UserRepository',
        'ThreadRepository',
        'PostRepository',
        'PostFavoriteRepository',
        'PostReplyRepository',
        'ModeratorRepository',
        'ReportAbuseRepository',
        'ModeratingRepository',
        'UserLoginRepository'
    ];

    /**
     * List of services that needs to be binded
     *
     * @var array
     */
    private $services = [
        'TestService',
        'AuthService',
        'HomeService'
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
        Collection::macro('toDropdown', function ($value_key, $text_key)
        {
            return $this->mapWithKeys(function ($item) use ($value_key, $text_key)
            {
                return [$item[$value_key] => $item[$text_key]];
            });
        });

        Collection::macro('withoutTimestamp', function ()
        {
            return $this->map(function ($model)
            {
                $result = collect($model->toArray());
                return $result->except(['created_at', 'updated_at', 'deleted_at']);
            });
        });
    }
}
