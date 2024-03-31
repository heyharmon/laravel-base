<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Seeding configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for local database seeding.
    | These are sensitive env variables we use in seeding.
    |
    |
    */
    
    'user_password' => env('SEED_USER_PASSWORD'),
    'connection_id_token' => env('SEED_CONNECTION_ID_TOKEN'),
    'connection_access_token' => env('SEED_CONNECTION_ACCESS_TOKEN'),
    'connection_refresh_token' => env('SEED_CONNECTION_REFRESH_TOKEN'),

];
