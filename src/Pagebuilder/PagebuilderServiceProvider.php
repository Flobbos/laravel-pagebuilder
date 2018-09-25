<?php

namespace Flobbos\Pagebuilder;

use Illuminate\Support\ServiceProvider;

class PagebuilderServiceProvider extends ServiceProvider{
    
    public function boot(){
        //Publish config and translations
        $this->publishes([
            //__DIR__.'/../config/pagebuilder.php' => config_path('pagebuilder.php'),
            __DIR__.'/../resources/views' => resource_path('views/vendor/pagebuilder'),

            //publish pagebuilder js assets
            __DIR__.'/../resources/assets/js/admin_components/' => resource_path('js/admin_components'),
            __DIR__.'/../resources/assets/js/pagebuilder.js' => resource_path('js/pagebuilder.js')
        ]);
        //load routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        //migrations
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
        //views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'pagebuilder');
        //language
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'pagebuilder');

    }

    /**
     * Register the service provider.
     */
    public function register(){
        //register commands
        /*$this->commands([
            //Commands\Command::class,
        ]);*/
        //Merge config
        $this->mergeConfigFrom(
            __DIR__.'/../config/pagebuilder.php', 'pagebuilder'
        );
        //Run fixed bindings
        $this->app->bind(Contracts\ElementContract::class, Elements::class);
        $this->app->bind(Contracts\PagebuilderContract::class, Pagebuilder::class);
        $this->app->bind(Contracts\LanguageContract::class, Languages::class);
    }
}
