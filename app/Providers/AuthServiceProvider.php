<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as BaseAuthServiceProvider;
use App\Models\Task;
use App\Models\Note;
use App\Policies\TaskPolicy;
use App\Policies\NotePolicy;

class AuthServiceProvider extends BaseAuthServiceProvider
{

    protected $policies =[
        Task::class=>TaskPolicy::class,
        Note::class=>NotePolicy::class,
    ];
   
    /**
     * Register services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies(); 
    }
}
