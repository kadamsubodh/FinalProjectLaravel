<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '2106466276059478',
        'client_secret' => '98d6074587e4ae5c7884c23ef8ad5a3a',
        'redirect' => 'http://localhost:8000/auth/social/callback/facebook',
    ],

    'google' => [
        'client_id' => '663808137791-iib0m00hdfinot1c50vhm0npqdqcjcv4.apps.googleusercontent.com',
        'client_secret' => 'MtMVlJrUWjpsuZI23_Fqsr1O',
        'redirect' => 'http://localhost:8000/auth/social/callback/google',
    ],
    'twitter' => [
        'client_id' => 'P2Zpnp7rSWMObPYIfShrJX4ES',
        'client_secret' => 'hpcQRP7lI0rmUgr6f8ghSwmKlQZvS0H5st5D9qxDEOExfKAsD0',
        'redirect' => ' twitterkit-P2Zpnp7rSWMObPYIfShrJX4ES://',
    ],

];
