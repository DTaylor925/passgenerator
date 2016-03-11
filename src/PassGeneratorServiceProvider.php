<?php namespace Thenextweb;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class PassGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {

        $this->package('thenextweb/passgenerator');
        //$this->setupConfig();

        //$this->publishAllConfigs();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('PassGenerator', 'Thenextweb\Facades\PassGenerator');
        });

        $this->app['passgenerator'] = $this->app->share(function($app)
        {
            return new PassGenerator;
        });

        $this->app['config']->package('thenextweb/passgenerator', __DIR__.'/config');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array("passgenerator");
    }

}
