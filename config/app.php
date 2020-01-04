<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Acnologia'),

    'key_prefix' => env('KEY_PREFIX', ''),

    'providers' => [
        WebTheory\Zeref\Providers\FormRepositoryServiceProvider::class,
        WebTheory\Zeref\Providers\GuzzleResponseFactoryServiceProvider::class,
        WebTheory\Zeref\Providers\PostTypeServiceProvider::class,
        WebTheory\Zeref\Providers\SwiftMailerServiceProvider::class,
        WebTheory\Zeref\Providers\TaxonomyServiceProvider::class,
        WebTheory\Zeref\Providers\WpAdminFieldFactoryServiceProvider::class,
    ],
];
