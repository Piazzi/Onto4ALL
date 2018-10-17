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
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'github' => [
        'client_id' => 'b62138e4b0cc03ed2189',         // Your GitHub Client ID
        'client_secret' => env('a0a6a2740d2688693927ea78ce65cf74c26e82d6'), // Your GitHub Client Secret
        'redirect' => env ( 'GITHUB_REDIRECT' ),
    ],

    'facebook' => [
        'client_id' => '1431060400372178',         // Your Facebook Client ID
        'client_secret' => env('1041ec0dc2892d557764cb208ca31cc3'), // Your Facebook Client Secret
        'redirect' => env ('FB_REDIRECT')
    ],

    'google' => [
        'client_id' => '623565151393-8hk5d7qqa8b3ai6ihl6t8lstug9q1b43.apps.googleusercontent.com', // Your Google Client ID
        'client_secret' => env('x4_LjsZdkKQuEWv2qBtzlHLW'), // Your Google Client Secret
        'redirect' => env ( 'G+_REDIRECT' ),
    ],

];
