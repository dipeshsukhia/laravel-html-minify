<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Env Variable for HTML_MINIFY
    |--------------------------------------------------------------------------
    |
    | Set this value to the false if you don't need html minify
    | this is by default "true"
    |
    */
    'default' => env('HTML_MINIFY', true),

    // exclude route name for exclude from minify
    'exclude_route' => [
        // 'routeName'htmlminify.exclude_route
    ],
    
    'status_server_error' => [
        500,
        501,
        502,
        503,
        504,
        505,
        506,
        507,
        508,
        510,
        511
    ],
];
