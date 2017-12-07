<?php

namespace Freyo\Xinge;

use Freyo\Xinge\Client\XingeApp;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $config = config('services.xinge');

        $this->app->singleton('xinge.android', function () use ($config) {
            return new Client(
                new XingeApp(
                    $config['android']['access_id'],
                    $config['android']['secret_key']
                )
            );
        });

        $this->app->singleton('xinge.ios', function () use ($config) {
            return new Client(
                new XingeApp(
                    $config['ios']['access_id'],
                    $config['ios']['secret_key']
                )
            );
        });

        $this->app->when(AndroidChannel::class)
            ->needs(Client::class)
            ->give('xinge.android');

        $this->app->when(iOSChannel::class)
            ->needs(Client::class)
            ->give('xinge.ios');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config.php', 'services.xinge'
        );
    }
}