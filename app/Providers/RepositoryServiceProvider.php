<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Interfaces
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\DivisionRepositoryInterface;
use App\Interfaces\MethodRepositoryInterface;
use App\Interfaces\RefundRepositoryInterface;

// Repositories
use App\Repositories\UserRepository;
use App\Repositories\DivisionRepository;
use App\Repositories\methodRepository;
use App\Repositories\RefundRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(DivisionRepositoryInterface::class, DivisionRepository::class);
        $this->app->bind(MethodRepositoryInterface::class, MethodRepository::class);
        $this->app->bind(RefundRepositoryInterface::class, RefundRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
