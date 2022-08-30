<?php

namespace Murdercode\TinymceEditor;

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
