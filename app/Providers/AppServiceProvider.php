<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Contracts\TaskRepositoryInterface;
use App\Repositories\TaskRepository;
use App\Repositories\Contracts\NoteRepositoryInterface;
use App\Repositories\NoteRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
        TaskRepositoryInterface::class,
        TaskRepository::class );

        $this->app->bind(NoteRepositoryInterface::class, NoteRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
