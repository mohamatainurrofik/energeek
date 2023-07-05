<?php

namespace App\Providers;

use App\Repositories\Candidate\CandidateRepository;
use App\Repositories\Candidate\CandidateRepositoryImplement;
use App\Services\Candidate\CandidateServiceImplement;
use App\Services\Candidate\CandidateService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CandidateRepository::class, CandidateRepositoryImplement::class);
        $this->app->bind(CandidateService::class, CandidateServiceImplement::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
