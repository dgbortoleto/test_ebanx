<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\AccountRepositoryInterface;
use App\Repositories\InMemory\InMemoryAccountRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AccountRepositoryInterface::class, InMemoryAccountRepository::class);
    }
}
