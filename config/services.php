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
        'client_id' => '478617941414-59ljqse9e4tnn9a504dvh5a0d4p26qqk.apps.googleusercontent.com',
        'client_secret' => '4HmOwwJcWnNftBqLAIhbrp86',
        'redirect' => 'https://tp.jadeitegroup.com/callback/google',
    ],


    'facebook' => [
        'client_id' => '401773860514280',
        'client_secret' => 'b5b5699f210d5f695208453df2ad38dc',
        'redirect' => 'https://tp.jadeitegroup.com/callback/facebook',
    ],


];
