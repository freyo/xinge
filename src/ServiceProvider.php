<?php

namespace Freyo\Xinge;

use Freyo\Xinge\Client\XingeApp;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $config = config('services.xinge');

        $this->app->when(AndroidChannel::class)
            ->needs(Client::class)
            ->give(function () use ($config) {
                return new Client(
                    new XingeApp(
                        $config['android']['access_id'],
                        $config['android']['secret_key']
                    )
                );
            });

        $this->app->when(iOSChannel::class)
            ->needs(Client::class)
            ->give(function () use ($config) {
                return new Client(
                    new XingeApp(
                        $config['ios']['access_id'],
                        $config['ios']['secret_key']
                    )
                );
            });
    }
}
