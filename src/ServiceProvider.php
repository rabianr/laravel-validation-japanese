<?php

namespace Rabianr\Validation\Japanese;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register the config for publishing
     *
     * @param  Router  $router
     */
    public function boot(Router $router)
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'japaneseValidation');

        $this->publishes(
            [__DIR__.'/../resources/lang' => resource_path('lang/vendor/japaneseValidation')],
            'japaneseValidation'
        );
    }
}
