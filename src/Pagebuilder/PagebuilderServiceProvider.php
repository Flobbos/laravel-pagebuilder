<?php

namespace Flobbos\Pagebuilder;

use Illuminate\Support\ServiceProvider;

class PagebuilderServiceProvider extends ServiceProvider{
    
    public function boot(){
        //Publish config
        $this->publishes([
            __DIR__.'/../config/pagebuilder.php' => config_path('pagebuilder.php'),
        ],'config');
        //load routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        //migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
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
        $this->commands([
            Commands\ControllerCommand::class,
            Commands\ViewCommand::class,
            Commands\ModelCommand::class,
            Commands\InstallCommand::class,
        ]);
        //Merge config
        $this->mergeConfigFrom(
            __DIR__.'/../config/pagebuilder.php', 'pagebuilder'
        );
        //Run fixed bindings
        $this->app->bind(Contracts\ElementContract::class, Elements::class);
        $this->app->bind(Contracts\PagebuilderContract::class, Pagebuilder::class);
        $this->app->bind(Contracts\RowColumnContract::class, RowColumn::class);
        $this->app->bind(Contracts\LanguageContract::class, Languages::class);
    }
}
