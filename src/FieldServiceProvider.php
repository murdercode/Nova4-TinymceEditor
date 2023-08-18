<?php

namespace Murdercode\TinymceEditor;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('tinymce-editor', __DIR__.'/../dist/js/field.js');
            Nova::style('tinymce-editor', __DIR__.'/../dist/css/field.css');
        });

        $this->publishes([
            __DIR__.'/../config/nova-tinymce-editor.php' => config_path('nova-tinymce-editor.php'),
        ], 'config');

        // Routes
        $this->app->booted(function () {
            $this->routes();
        });
    }

    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware('nova:api')
            ->prefix('nova-vendor/murdercode/tinymce')
            ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
