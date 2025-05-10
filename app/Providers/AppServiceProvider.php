<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use App\Repositories\Interfaces\AccountRepositoryInterface;
use App\Repositories\InMemory\InMemoryAccountRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AccountRepositoryInterface::class, InMemoryAccountRepository::class);
    }

    public function boot()
    {
        if (app()->environment('local')) {
            URL::forceScheme('https');
        }
    }
}
