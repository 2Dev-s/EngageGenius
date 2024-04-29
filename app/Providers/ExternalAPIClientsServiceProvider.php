<?php

namespace App\Providers;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\ServiceProvider;

class ExternalAPIClientsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    
    public function register(): void
    {
        //
    $this->app->singleton('LinkedInAPIClient', function () {
        return new \LinkedInscr\Client(
            '77irngxzr7ujjl',
            'b4ZKLnNWBOp7PYuu'
        );
    });

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
