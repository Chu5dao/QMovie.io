<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    
    'google' => [
        'client_id' => '310182406620-ivmqljr6j9jnt8b7cdr3t526gvkhonj8.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => env('APP_URL').'/google/callback',
        // 'redirect' => env('APP_URL').'/auth/google/callback',
    ],

    'facebook' => [
        'client_id' => '1032939334849884',
        'client_secret' => '39288b8e4ddb8393ecfc2b764219e064',
        'redirect' => 'http://localhost:8000/facebook/callback',
    ],
];
